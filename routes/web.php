<?php

use App\Models\City;
use App\Models\Client;
use App\Models\Hotel;
use App\Models\Order;
use App\Models\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $check_in = "2024-07-01";
    $check_out = "2024-07-08";
    $city_id = 2;
    $room_size = 2;
    // $results = DB::table('rooms')
    // ->select('rooms.*', 'room_types.size', 'room_types.price', 'room_types.amount', 'hotels.name as hotel_name', 'hotels.id as hotel_id')
    // ->join('room_types', 'rooms.room_type_id', '=', 'room_types.id')
    // ->join('hotels', 'rooms.hotel_id', '=', 'hotels.id')
    // ->whereNotExists(function ($query) use ($check_in, $check_out) {
    //     $query->select('reservations.id')
    //             ->from('reservations')
    //             ->join('reservation_room', 'reservations.id', '=', 'reservation_room.reservation_id')
    //             ->whereColumn('rooms.id', 'reservation_room.room_id')
    //             ->where(function ($q) use ($check_in, $check_out) {
    //                     $q->where('check_out', '>', $check_in);
    //                     $q->where('check_in', '<', $check_out);
    //                 })
    //                 ->limit(1);
    // })
    // ->whereExists(function($q) use($city_id) {
    //     $q->select('hotels.id')
    //             ->from('hotels')
    //             ->whereColumn('rooms.hotel_id','hotels.id')
    //             ->whereExists(function($q) use($city_id) {
    //                 $q->select('cities.id')
    //                 ->from('cities')
    //                 ->whereColumn('cities.id','hotels.city_id')
    //                 ->where('id', $city_id)
    //                 ->limit(1);
    //             })
    //             ->limit(1);
    // })
    // ->where('room_types.size', '=', $room_size)
    // ->where('room_types.amount', '>', 0)
    // ->orderBy('room_types.price', 'ASC')
    // ->paginate(10);
    
    // $results = Room::with(['type', 'hotel'])
    //     ->whereDoesntHave('reservations' , function($q) use ($check_in, $check_out) {
    //                 $q->where(function($q) use($check_in, $check_out) {
    //                     $q->where('check_out', '>', $check_in);
    //                     $q->where('check_in', '<', $check_out);
    //             });
    //         })
    //         ->whereHas('hotel.city', function($q) use ($city_id) {
    //             $q->where('id', $city_id);
    //         })
    //         ->whereHas('type', function($q) use($room_size){
    //             $q->where('amount', '>', 0);
    //             $q->where('size', '=', $room_size);
    //         })
    //         ->paginate(10)
    //         ->sortBy('type.price');

    $hotel_id = range(1,10);
    // $results = Room::whereHas('hotel', function($q) use ($hotel_id) {
    //     $q->whereIn('hotel_id', $hotel_id);
    // })
    // ->withCount('reservations')
    // ->orderBy('reservations_count', 'DESC')
    // ->get();
    // $result = Hotel::whereIn('id', $hotel_id)
    //         ->withCount('rooms')
    //         ->orderBy('rooms_count', 'DESC')
    //         ->get();
    // $users = DB::table('users')->orderByDesc(
    //     DB::table('reservations')
    //     ->whereColumn('users.id','reservations.user_id')
    //     ->select('price')
    //     ->orderByDesc('price')
    //     ->limit(1)
    // )
    // ->get();
    // $city = City::findOrFail(1);
    // $hotel = new Hotel();
    // $hotel->name = "New Hotel Name";
    // $hotel->description = "New Hotel Description";
    // $hotel->city()->associate($city);
    // $result = $hotel->save();


    $clients = Client::all(); // with lazy loading of clients
    $clients = Client::with('orders.order_details')->get(); // with eager loading of clients

    // get all products with specific order
    $products = DB::table('products')
                ->join('order_details','order_details.product_code', '=', 'products.product_code')
                ->where('order_details.order_id', 1)
                ->get();

// get all products with sort by most sold product
    $most_sold_products = DB::table('products')
                ->join('order_details', 'order_details.product_code', '=', 'products.product_code')
                ->select('products.product_code', 'products.product_name', 'products.product_manufacturer', 'products.product_unit_price', DB::raw('COUNT(order_details.product_code) as total_sold'))
                ->groupBy('products.product_code', 'products.product_name', 'products.product_manufacturer', 'products.product_unit_price')
                ->orderBy('total_sold', 'DESC')
                ->get();
    // creating a new order for a client

    $client = Client::findOrFail(1);
    $order = new Order();
    $order->order_date = now();
    $order->order_value = 10221;
    $order->client()->associate($client);
    $order->save();
    
            
    dump($order);
    return view('welcome');

});