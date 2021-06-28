<div class="countryList">
    <select id="address" name="address" size="8" style="width: 235px; padding-top: 5px" onchange="run()">
        @if(empty($addRess))
            <option value="">Địa điểm không tìm thấy</option>
        @else
        @foreach($addRess as $item)
        <option value="{{$item['searchCode']}}">{{$item['name']}}</option>
        @endforeach
        @endif
    </select>

</div>


