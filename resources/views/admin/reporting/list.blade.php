@extends('admin.layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
        <h2>History Product Item Changes</h2>
        </div>

        @foreach ($history_create as $history)      
            <div class="card-body shadow-sm p-0 mb-0 bg-body-tertiary rounded" >
                <blockquote class="blockquote mb-0">   
                    <div class="card1">            
                        <p>Changed on {{ $history->created_at }}</p>
                        <ul style="">
                            <li>
                                <h3 style="display:inline;">Product :</h3> <p style="display:inline;">{{ $history->title_bfr }}</p><br>
                            </li>
                            <li>
                                <h3 style="display:inline;">Price :</h3> <p style="display:inline;">{{ $history->price_bfr }}</p>
                            </li>
                            <li>
                                <h3 style="display:inline;">Quantity :</h3> <p style="display:inline;">{{ $history->qty_bfr }}</p>
                            </li>
                        </ul>
                    </div>
                    <div class="card2">
                        <p>Reference Product</p>
                        <ul style="">
                            <li>
                                <h3 style="display:inline;">Product :</h3> <p style="display:inline;">{{ $history->Product->title }}</p><br>
                            </li>
                            <li>
                                <h3 style="display:inline;">Price :</h3> <p style="display:inline;">{{ $history->Product->price }}</p>
                            </li>
                            <li>
                                <h3 style="display:inline;">Quantity :</h3> <p style="display:inline;">{{ $history->Product->qty }}</p>
                            </li>
                        </ul>
                    </div>
                </blockquote>
            </div>   
        @endforeach      
    </div> 
@endsection

@section('customJs')
<script>

</script>
@endsection