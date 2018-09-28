@extends('admin.AdminPublic.index')
@section('title','木知网后台')
@section('container')
<!--右侧显示内容区域 开始-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb panel">
                <li><a href="/bk_index"><i class="fa fa-home"></i> 首页</a></li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
          <!--statistics start-->
          <div class="row state-overview">
            <div class="col-md-6 col-xs-12 col-sm-6">
              <div class="panel purple">
                <div class="symbol">
                  <i class="fa fa-user-md"></i>
                </div>
                <div class="state-value">
                  <div class="value">{{$users_count}}</div>
                  <div class="title">注册会员数量</div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-6">
              <div class="panel red">
                <div class="symbol">
                  <i class="fa fa-tags"></i>
                </div>
                <div class="state-value">
                  <div class="value">{{$cates_count}}</div>
                  <div class="title">分类数量</div>
                </div>
              </div>
            </div>
          </div>
          <div class="row state-overview">
            <div class="col-md-6 col-xs-12 col-sm-6">
              <div class="panel purple" style="background: #2be278;box-shadow: 0 5px 0 #2be278;">
                <div class="symbol">
                  <i class="fa fa-check-square"></i>
                </div>
                <div class="state-value">
                  <div class="value">{{$qiandao_count}}</div>
                  <div class="title">本日签到数量</div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-6">
              <div class="panel red" style="background: #fb8f56;box-shadow: 0 5px 0 #fb8f56;">
                <div class="symbol">
                  <i class="fa fa-edit"></i>
                </div>
                <div class="state-value">
                  <div class="value">{{$data_count}}</div>
                  <div class="title">会员投稿记录</div>
                </div>
              </div>
            </div>
          </div>
          <div class="row state-overview">
            <div class="col-md-6 col-xs-12 col-sm-6">
              <div class="panel blue">
                <div class="symbol">
                  <i class="fa fa-money"></i>
                </div>
                <div class="state-value">
                  <div class="value">{{$links_count}}</div>
                  <div class="title"> 友情链接数量</div>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-xs-12 col-sm-6">
              <div class="panel green">
                <div class="symbol">
                  <i class="fa fa-clipboard"></i>
                </div>
                <div class="state-value">
                  <div class="value">{{$content_count}}</div>
                  <div class="title"> 日记数量</div>
                </div>
              </div>
            </div>
          </div>
          <!--statistics end-->
        </div>
       <div class="col-md-6">
          <div class="panel">
              <div class="panel-body">
                  <div class="calendar-block ">
                      <div class="cal1"><div class="clndr"><div class="clndr-controls"><div class="clndr-control-button"><span class="clndr-previous-button"><i class="fa fa-chevron-left"></i></span></div><div class="month"><span>September</span> 2018</div><div class="clndr-control-button leftalign"><span class="clndr-next-button"><i class="fa fa-chevron-right"></i></span></div></div><table class="clndr-table" border="0" cellspacing="0" cellpadding="0"><thead><tr class="header-days"><td class="header-day">S</td><td class="header-day">M</td><td class="header-day">T</td><td class="header-day">W</td><td class="header-day">T</td><td class="header-day">F</td><td class="header-day">S</td></tr></thead><tbody><tr><td class="day past adjacent-month last-month calendar-day-2018-08-26"><div class="day-contents">26</div></td><td class="day past adjacent-month last-month calendar-day-2018-08-27"><div class="day-contents">27</div></td><td class="day past adjacent-month last-month calendar-day-2018-08-28"><div class="day-contents">28</div></td><td class="day past adjacent-month last-month calendar-day-2018-08-29"><div class="day-contents">29</div></td><td class="day past adjacent-month last-month calendar-day-2018-08-30"><div class="day-contents">30</div></td><td class="day past adjacent-month last-month calendar-day-2018-08-31"><div class="day-contents">31</div></td><td class="day past calendar-day-2018-09-01"><div class="day-contents">1</div></td></tr><tr><td class="day past calendar-day-2018-09-02"><div class="day-contents">2</div></td><td class="day past calendar-day-2018-09-03"><div class="day-contents">3</div></td><td class="day past calendar-day-2018-09-04"><div class="day-contents">4</div></td><td class="day past calendar-day-2018-09-05"><div class="day-contents">5</div></td><td class="day past calendar-day-2018-09-06"><div class="day-contents">6</div></td><td class="day past calendar-day-2018-09-07"><div class="day-contents">7</div></td><td class="day past calendar-day-2018-09-08"><div class="day-contents">8</div></td></tr><tr><td class="day past calendar-day-2018-09-09"><div class="day-contents">9</div></td><td class="day past event calendar-day-2018-09-10"><div class="day-contents">10</div></td><td class="day past event calendar-day-2018-09-11"><div class="day-contents">11</div></td><td class="day past event calendar-day-2018-09-12"><div class="day-contents">12</div></td><td class="day today event calendar-day-2018-09-13"><div class="day-contents">13</div></td><td class="day event calendar-day-2018-09-14"><div class="day-contents">14</div></td><td class="day calendar-day-2018-09-15"><div class="day-contents">15</div></td></tr><tr><td class="day calendar-day-2018-09-16"><div class="day-contents">16</div></td><td class="day calendar-day-2018-09-17"><div class="day-contents">17</div></td><td class="day calendar-day-2018-09-18"><div class="day-contents">18</div></td><td class="day calendar-day-2018-09-19"><div class="day-contents">19</div></td><td class="day calendar-day-2018-09-20"><div class="day-contents">20</div></td><td class="day event calendar-day-2018-09-21"><div class="day-contents">21</div></td><td class="day event calendar-day-2018-09-22"><div class="day-contents">22</div></td></tr><tr><td class="day event calendar-day-2018-09-23"><div class="day-contents">23</div></td><td class="day calendar-day-2018-09-24"><div class="day-contents">24</div></td><td class="day calendar-day-2018-09-25"><div class="day-contents">25</div></td><td class="day calendar-day-2018-09-26"><div class="day-contents">26</div></td><td class="day calendar-day-2018-09-27"><div class="day-contents">27</div></td><td class="day calendar-day-2018-09-28"><div class="day-contents">28</div></td><td class="day calendar-day-2018-09-29"><div class="day-contents">29</div></td></tr><tr><td class="day calendar-day-2018-09-30"><div class="day-contents">30</div></td><td class="day adjacent-month next-month calendar-day-2018-10-01"><div class="day-contents">1</div></td><td class="day adjacent-month next-month calendar-day-2018-10-02"><div class="day-contents">2</div></td><td class="day adjacent-month next-month calendar-day-2018-10-03"><div class="day-contents">3</div></td><td class="day adjacent-month next-month calendar-day-2018-10-04"><div class="day-contents">4</div></td><td class="day adjacent-month next-month calendar-day-2018-10-05"><div class="day-contents">5</div></td><td class="day adjacent-month next-month calendar-day-2018-10-06"><div class="day-contents">6</div></td></tr></tbody></table></div></div>
                  </div>

              </div>
          </div>
      </div>
    </div>
</div>
<!--右侧显示内容区域 结束-->
@endsection
