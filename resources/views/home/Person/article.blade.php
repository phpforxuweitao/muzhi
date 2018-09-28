 @extends('home.PersonPublic.index')
  @section('title','我的文章') 
  @section('container') 
  <div class="ab_right" style="padding-top:0"> 
   <!--<div class="shop-nav"><a>我的投稿</a></div>--> 
   <div class="newArticle_cz"> 
    <table id="hy_table" class="hy_table" width="100%" cellspacing="0" cellpadding="0" border="0"> 
     <thead> 
      <tr> 
       <td style="text-align:center;">文章标题</td> 
       <td width="15%">审核状态</td>  
       <td width="20%">时间</td> 
       <td style="border:none;" width="10%">操作</td> 
      </tr> 
     </thead> 
     <tbody> 
      @if($count < 1)
        <td align="center" class="hy_title" colspan="4">暂无数据</td>
      @else
        @foreach($data as $v)
        <tr>
         <td class="hy_title"> {{$v->title}}</td> 
         <td>
           <font color="black">
             @if($v->status == 0)
              通过审核
             @elseif($v->status == 1)
              审核中
             @elseif($v->status == 2)
              未通过审核
             @endif
           </font>
         </td>
         <td>{{date("Y-m-d H:i:s",$v->updated_at)}}</td> 
         <td class="tools"> 
          <a href="ps_article/del/{{$v->id}}">删除</a> 
         </td>
        </tr>
        @endforeach
      @endif
     </tbody> 
    </table> 
    <div class="article_pages">
     {{$data->render()}}
    </div> 
   </div> 
  </div>

   @endsection 
 