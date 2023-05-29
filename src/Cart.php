<?php 
namespace Anwar\ShoppingCart;

class Cart{

    public function add($id, $name, $quantity = 1, $price, $discount = 0, $variation = "", $image = "")
    {

        $cart = $this->content();
        
        if(isset($cart[$id]))
        {
            $new_quantity = $cart[$id]['quantity'] + $quantity;
            $new_discount = $quantity * $discount;
            $new_row_total = ($quantity * $price) - $new_discount;
            $cart[$id]['quantity'] = $new_quantity;
            $cart[$id]['row_total'] += $new_row_total;
            $cart[$id]['total_discount'] += $new_discount;

            if(!empty($variation))
            {
                $cart[$id]['variation'] = $variation;
            }
        }
        else{
            $final_discount = $discount * $quantity;
            $row_total = ($price * $quantity) - $final_discount;
            $cart[$id] = [
                "name" => $name,
                "quantity" => $quantity,
                "price" => $price,
                "discount" => $discount,
                "variation" => $variation,
                "image" => $image,
                "row_total" => $row_total,
                "total_discount" => $final_discount,
    
            ];
            
        }

        $this->put($cart);
        
        return $this->content();
    }

    public function get($id)
    {
        $cart = $this->content();
        if(isset($cart[$id]))
        {
            return $cart[$id];
        }
        
        return 0;
    }

    public function update($id, $quantity = "", $variation = "")
    {
        $cart = $this->content();
        if(isset($cart[$id]))
        {
            if(!empty($quantity))
            {
                $final_discount = $quantity * $cart[$id]['discount'];
                $final_row_total = ($quantity * $cart[$id]['price']) - $final_discount;
                $cart[$id]['quantity'] = $quantity;
                $cart[$id]['row_total'] = $final_row_total;
                $cart[$id]['total_discount'] = $final_discount;
            }            
            
            if(!empty($variation))
            {
                $cart[$id]['variation'] = $variation;
            }

            $this->put($cart);

            return 1;
        }
        
        return 0;

    }    
    
    public function remove($id)
    {
        $cart = $this->content();
        if(isset($cart[$id]))
        {
            unset($cart[$id]);
            $this->put($cart);

            return 1;
        }
        
        return 0;
        

    }

    public function count()
    {
        return count($this->content());
    }    
    
    public function discount()
    {
        return $this->cartIteration()['total_discount'];
    }    
    
    public function subtotal()
    {
        return $this->cartIteration()['subtotal'];
    }   
    
    public function cartIteration()
    {
        $cart = $this->content();
        $discount = 0;
        $subtotal = 0;
        foreach($cart as $item)
        {   
            $discount += $item['total_discount'];
            $subtotal += $item['row_total'];
        }

        return ['total_discount' => $discount, 'subtotal' => $subtotal];
    }
    
    public function destroy()
    {
        return $this->put([]);
    }

    public function content()
    {
        return session()->get('cart', []);
    }
    

    public function put($data = [])
    {
        session()->put('cart', $data);
    }
    
    


}