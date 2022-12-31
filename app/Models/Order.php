<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const MODEL_NAME = 'Order';

    const STATUS_DRAFT = 'Draft';
    const STATUS_PENDING_PAYMENT = 'Pending Payment';
    const STATUS_ACTIVE = 'Active';
    const STATUS_COMPLETED = 'Completed';
    const STATUS_CANCELLED = 'Cancelled';

    const BASE_PRICE = 8;

    const FORMATTING_OPTIONS = [
        'APA',
        'MLA',
        'Chicago',
        'Harvard',
        'Other'
    ];

    protected $fillable = [
        'paper_type_id',
        'academic_level_id',
        'subject_id',
        'user_id',
        'pages',
        'title',
        'instructions',
        'formatting',
        'urgency', // in hours
        'price',
        'status'
    ];

    public $timestamps = true;


    // RELATIONS
    public function paperType(){
        return $this->belongsTo(PaperType::class, 'paper_type_id');
    }

    public function academicLevel(){
        return $this->belongsTo(AcademicLevel::class, 'academic_level_id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function attachments(){
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }


    // Scopes
    public function scopeCompleted($query){
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopePendingPayment($query){
        return $query->where('status', self::STATUS_PENDING_PAYMENT);
    }

    public function scopeActive($query){
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeCancelled($query){
        return $query->where('status', self::STATUS_CANCELLED);
    }

    public function scopeDraft($query){
        return $query->where('status', self::STATUS_DRAFT);
    }


    // Accessors
    public function getFmtUrgencyAttribute(){
        if($this->urgency >= 24 && ($this->urgency % 24) == 0){
            $urgency = $this->urgency / 24;
            return $urgency . ' Day'.($urgency > 1 ? 's' : '');
        }else{
            return $this->urgency . ' Hours';
        }
    }

    public function getFmtPriceAttribute(){
        return '$' . number_format($this->price, 2);
    }

    function getFmtPagesAttribute(){
        return $this->pages . ' page'.($this->pages > 1 ? 's' : '');
    }

    public function getFmtCreatedAtAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getTimeRemainingAttribute(){
        // If past deadline, return none
        if($this->created_at->diffInHours(now()) >= $this->urgency){
            return 'None';
        }

        // days, hours:minutes
        $timeRemaining = $this->urgency - $this->created_at->diffInHours(now());

        // If 0 hours, return minutes
        if($timeRemaining == 0){
            $minutes = $this->created_at->diffInMinutes(now());
            return $minutes . ' minute'.($minutes > 1 ? 's' : '');
        }

        $days = floor($timeRemaining / 24);
        $hours = $timeRemaining % 24;
        return $days . ' day'.($days > 1 ? 's' : '').' '.$hours.' hour'.($hours > 1 ? 's' : '');
    }


    // Helpers
    public function calculatePrice(){
        $price = self::BASE_PRICE;

        // Add price for urgency
        if($this->urgency < 24){
            // If urgency is less than 24 hours, multiply by 3
            $price *= 3;
        }elseif($this->urgency < 48){
            // If urgency is less than 48 hours, multiply by 2
            $price *= 2;
        }elseif($this->urgency < 72){
            // If urgency is less than 72 hours, multiply by 1.5
            $price *= 1.5;
        }

        // Multiply by number of pages
        $price *= $this->pages;

        // Update
        $this->price = $price;
        $this->save();
    }


    function isDraft(){
        return $this->status == self::STATUS_DRAFT;
    }

    function isPendingPayment(){
        return $this->status == self::STATUS_PENDING_PAYMENT;
    }

    function isActive(){
        return $this->status == self::STATUS_ACTIVE;
    }

    function isCompleted(){
        return $this->status == self::STATUS_COMPLETED;
    }

    function isCancelled(){
        return $this->status == self::STATUS_CANCELLED;
    }
}
