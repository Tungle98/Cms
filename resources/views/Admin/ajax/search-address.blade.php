<div class="countryList">
    <select name="address">
        @if(empty($addRess))
            <option disabled>Không có kết quả</option>
        @else
            @foreach($addRess as $item)
                <option>{{$item['name']}}</option>
            @endforeach
        @endif
    </select>
</div>


