<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SharingDecisionNode;
use App\Services\QuestionnaireService;


class SharingQuestionnaireController extends Controller
{

    public function index()
    {
        // Start at root (assume id=1)
        $root = SharingDecisionNode::find(1);

        return view('web.sharing.questionnaire-iframe', [
            'firstQuestion' => $root
        ]);
    }

    public function answer(Request $request, QuestionnaireService $service)
    {
        $node = SharingDecisionNode::find($request->input('node_id'));
        $answer = $request->input('answer');

        $nextNode = $service->getNextNode($node, $answer);

        if (!$nextNode) {
            return response()->json([
                'done' => true,
                'message' => 'No further question.'
            ]);
        }

        if ($nextNode->is_leaf) {
            return response()->json([
                'done' => true,
                'result' => $nextNode->result,
                'organisations' => $nextNode->organisations->map(function($org) {
                    return [
                        'name' => $org->name,
                        'website' => $org->website
                    ];
                })
            ]);
        }

        return response()->json([
            'done' => false,
            'node_id' => $nextNode->id,
            'question' => $nextNode->question,
            'answers' => $nextNode->edges->pluck('answer')
        ]);
    }
}
