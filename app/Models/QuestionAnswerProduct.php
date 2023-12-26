<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionAnswerProduct extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'question_answer_products';
    protected  $fillable = [
            'question',
            'answer',
            'user_id',
            'product_id',
            'parent_id',
    ];
}
