<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'description', 'image_url'
    ];

    public function productReviews()
    {
        return $this->hasMany('App\Models\ProductReview', 'product_id');
    }

    public function orderProducts($order_by)
    {
        $query = "SELECT p.*, oi.rating FROM products AS p 
        LEFT JOIN (SELECT product_id, AVG(rating) as rating FROM reviews 
        GROUP BY product_id) AS oi ON oi.product_id = p.id 
        ORDER BY created_at DESC;";

        if ($order_by == 'best_seller') {
            $query = "SELECT p.*, oi.quantity, r.rating FROM products AS p LEFT JOIN (SELECT product_id, SUM(quantity) as quantity FROM order_items GROUP BY product_id) AS oi ON oi.product_id = p.id LEFT JOIN (SELECT product_id, AVG(rating) as rating FROM reviews GROUP BY product_id) AS r ON r.product_id = p.id ORDER BY oi.quantity DESC;";
        } else if ($order_by == 'terbaik') {
            $query = "SELECT p.*, oi.rating FROM products AS p 
            LEFT JOIN (SELECT product_id, AVG(rating) as rating FROM reviews 
            GROUP BY product_id) AS oi ON oi.product_id = p.id 
            ORDER BY oi.rating DESC;";
        } else if ($order_by == 'termurah') {
            $query = "SELECT p.*, oi.rating FROM products AS p 
            LEFT JOIN (SELECT product_id, AVG(rating) as rating FROM reviews 
            GROUP BY product_id) AS oi ON oi.product_id = p.id 
            ORDER BY price ASC;";
        } else if ($order_by == 'termahal') {
            $query = "SELECT p.*, oi.rating FROM products AS p 
            LEFT JOIN (SELECT product_id, AVG(rating) as rating FROM reviews 
            GROUP BY product_id) AS oi ON oi.product_id = p.id 
            ORDER BY price DESC;";
        } else if ($order_by == 'terbaru') {
            $query = "SELECT p.*, oi.rating FROM products AS p 
            LEFT JOIN (SELECT product_id, AVG(rating) as rating FROM reviews 
            GROUP BY product_id) AS oi ON oi.product_id = p.id 
            ORDER BY created_at DESC;";
        }

        return DB::select($query);
    }
}
