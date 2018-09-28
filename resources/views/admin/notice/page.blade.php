<div id="page">
    <table class="display table table-bordered table-striped dataTable" id="dynamic-table" aria-describedby="dynamic-table_info">
        <thead>
            <tr role="row">
                <th width="60">编号</th>
                <th>公告名称</th>
                <th>公告内容</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody role="alert" aria-live="polite" aria-relevant="all">
            @foreach($data as $v)
            <tr class="gradeA odd">
                <td class="center">{{$v->id}}</td>
                <td class="center">{{$v->title}}</td>
                <td class="center">
                    <a href="/bk_notice/content/{{$v->id}}">{{changeStr(strip_tags($v->content),12,'...')}}</a>
                </td>
                <td class="center">
                    {{date('Y-m-d H:i:s',$v->created_at)}}
                </td>
                <td class="center hidden-phone">
                    <a class="btn btn-success" href="/bk_notice/edit/{{$v->id}}">修改</a>&nbsp;&nbsp;
                    <a class="btn btn-warning" href="/bk_notice/del/{{$v->id}}">删除</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
