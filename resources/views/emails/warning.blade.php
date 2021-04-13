<p>
    姓名: {{ $params['name'] }}
</p>

<p>
    email: {{ $params['email'] }}
</p>

<p>
    電話: {{ $params['phone'] }}
</p>

<p>
    內容: {{ $params['content'] }}
</p>

<p>
    詢價圖片鏈接:<br />
    <img src="{{ $params['img_src'] }}" />
</p>

<p>
    詢價頁面鏈接:
    {{ $params['exhibition_src'] }}
</p>
