<?php

namespace App\Services;

use App\Models\SharingDecisionNode;

class QuestionnaireService
{
    /**
     * Given the current node and an answer, return the next node
     */
    public function getNextNode(SharingDecisionNode $currentNode, string $answer): ? SharingDecisionNode
    {
        $edge = $currentNode->edges()->where('answer', $answer)->first();

        return $edge ? $edge->child : null;
    }
}
