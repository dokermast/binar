<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\BinarNode;
use App\Binar;

class BinarController extends Controller
{
    protected $root = NULL;

    public function isEmpty ()
    {
        return is_null($this->root);
    }


    public function insert ($value)
    {
        $node = new BinarNode($value);
        $this->insertNode($node, $this->root);
    }


    protected function insertNode (BinarNode $node, &$subtree)
    {
        if (is_null($subtree)){
            $subtree = $node;
        } else {
            if ($node->value < $subtree->value) {
                $subtree->position = BinarNode::LEFT;
                $this->insertNode($node, $subtree->position);
            } elseif ($node->value > $subtree->value) {
                $subtree->position = BinarNode::RIGHT;
                $this->insertNode($node, $subtree->position);
            }
        }
        return $this;
    }

    public function delete ($value)
    {
        if ($this->isEmpty()) {
            throw new \UnderflowException('Tree is empty!');
        }

        $node = &$this->findNode($value, $this->root);

        if ($node) {
            $this->deleteNode($node);
        }

        return $this;
    }


    protected function &findNode ($value, &$subtree)
    {
        if (is_null($subtree)) {

            return FALSE;
        }

        if ($subtree->value > $value) {

            $subtree->position = BinarNode::LEFT;

            return $this->findNode($value, $subtree->left);

        } elseif ($subtree->value < $value) {

            $subtree->position = BinarNode::RIGHT;

            return $this->findNode($value, $subtree->right);

        } else {

            return $subtree;
        }
    }

    protected function deleteNode (BinarNode &$node)
    {
//        if (is_null($node->left) && is_null($node->right)) {
        if (is_null($node->position)) {

            $node = NULL;

//        } elseif (is_null($node->left)) {
        } elseif ($node->position == BinarNode::LEFT) {

            $node = $node->position;

//        }  elseif (is_null($node->right)) {
        } elseif ($node->position == BinarNode::RIGHT) {

            $node = $node->position;

        } else {

            if (is_null($node->right->left)) {

                $node->right->left = $node->left;
                $node = $node->right;

            } else {

                $node->value = $node->right->left->value;
                $this->deleteNode($node->right->left);
            }
        }
    }

    public function dump ()
    {
        var_dump($this->root);
    }
}
