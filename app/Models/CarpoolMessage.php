<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class CarpoolMessage extends Model
{
    use HasFactory;

    public $table = 'carpool_messages';
    protected $fillable = ['message', 'user_id','conversation_partner_user_id', 'car_ride_id' ,
        'is_request_for_reservation', 'is_confirmation_for_reservation',
        'is_rejected_for_reservation',
        'is_ride_cancelled_for_reservation',
        'is_request_cancelled',
        'is_read'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function conversationPartner() {
        return $this->belongsTo(User::class, 'conversation_partner_user_id');
    }

    public function ride()
    {
        return $this->belongsTo(CarpoolRide::class, 'car_ride_id');
    }

    public function getTimeAttribute(): string {
        return date(
            "d M Y, H:i:s",
            strtotime($this->attributes['created_at'])
        );
    }


    /* ---- MISC -----*/
    /* get the last conversation, used to jump to when no conversation is specified */
    public function getLastConversation($userId) {
        $conversation = $this->where('user_id', $userId)
                            ->orWhere('conversation_partner_user_id', $userId)
                            ->orderBy('created_at', 'desc')->orderBy('is_read', 'asc')->first();

        return $conversation;
    }


    /*
        listing of all conversations, used in side navigation
        expects a messages object (see getConversationsQuery()) and returns a clean array
    */
    public function getConversationsWithRidesArray($messages) {

        $userId = Auth::user()->id;
        $cleanArray = [];
        $senderArr  = []; // used for a little trick to compile the list
        foreach($messages as $message) {
            if($message->conversation_partner_user_id !== $userId) {
                if(!in_array($message->car_ride_id.'-'.$message->conversation_partner_user_id, $senderArr)) {
                    $arr = [];
                    $arr['ride']                = $message->ride;
                    $arr['message']             = $message;
                    $arr['messageType']         = 'outgoing-message';
                    $arr['senderId']            = $message->conversation_partner_user_id;
                    $arr['senderNameFirstName'] = $message->conversationPartner->firstname;
                    $arr['senderNameLastName']  = $message->conversationPartner->lastname;
                    $arr['unreadTotal']         = 0;
                    $senderArr[]                = $message->car_ride_id.'-'.$message->conversation_partner_user_id;
                    $cleanArray[]               = $arr;
                }
            } else {
                if(!in_array($message->car_ride_id.'-'.$message->user_id, $senderArr)) {
                    $conversationUnreadTotal = $this->getConversationUnreadTotal($message->user_id, $message->car_ride_id);

                    $arr = [];
                    $arr['ride']                = $message->ride;
                    $arr['message']             = $message;
                    $arr['messageType']         = 'incoming-message';
                    $arr['senderId']            = $message->user_id;
                    $arr['senderNameFirstName'] = $message->user->firstname;
                    $arr['senderNameLastName']  = $message->user->lastname;
                    $arr['unreadTotal']         = $conversationUnreadTotal;
                    $senderArr[]                = $message->car_ride_id.'-'.$message->user_id;
                    $cleanArray[]               = $arr;
                }
            }
        }

        return $cleanArray;

    }

    public function getConversationsQuery() {

        $userId = Auth::user()->id;
        $messages = $this->where('user_id', $userId)
            ->orWhere('conversation_partner_user_id', $userId)
            ->orderBy('is_read', 'asc')
            ->orderBy('created_at', 'desc');

        return $messages;

    }


    public function getConversation($conversationPartnerUserId, $rideId) {

        $userId = Auth::user()->id;
        $conversations =  $this->where(function ($query) use  ($conversationPartnerUserId, $userId) {
                                $query->whereIn('conversation_partner_user_id', [$userId, $conversationPartnerUserId])
                                    ->whereIn('user_id',  [$userId, $conversationPartnerUserId]);
                                })
                        ->where('car_ride_id', $rideId)->orderBy('created_at', 'asc')->get();
        return $conversations;

    }

    // get total unread messages, only unread and from the conversation partner
    public function getConversationUnreadTotal($conversationPartnerUserId, $rideId) {

        $userId = Auth::user()->id;
        $totalCount =  $this->where('user_id', $conversationPartnerUserId)  // from
                            ->where('conversation_partner_user_id',  $userId)       // to you
                            ->where('car_ride_id', $rideId)
                            ->where('is_read', 0)->count();
        return $totalCount;

    }

    // user opened the thread so all conversations sent from the conversation partner can be moved to read
    public function setConversationsAsRead($conversationPartnerUserId, $rideId) {

        $userId = Auth::user()->id;
        $this->where('user_id', $conversationPartnerUserId)  // from
            ->where('conversation_partner_user_id',  $userId)       // to you
            ->where('car_ride_id', $rideId)
            ->where('is_read', 0)
            ->update(['is_read'=>'1']);

    }


}
