    <!--  foot  -->
    <div class="foot mt20">
        <div class="f-center clearfix">
            <div class="f-left">
                <!-- 友情链接 -->
                <div class="f-link mb20 tab">
                    <h3 class="mb10">
                        <span class="tag on">友情链接</span>
                        <span class="tag">教育部</span>
                    </h3>
<?php
    $friendly = Friendly::isFriendly()->notDeleted()->get();
?>
                    <ul class="hide show">
                        @foreach($friendly as $f)
                            <li><a href="{{$f->link}}" target="_blank">{{$f->name}}</a></li>
                        @endforeach
                    </ul>
<?php
    $education = Friendly::isEducation()->notDeleted()->get();
?>
                    <ul class="hide">
                        @foreach($education as $e)
                            <li><a href="{{$e->link}}" target="_blank">{{$e->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <!-- copyright -->
                <div class="f-copyright">
                    <p>Copyright @ 2016 Shanghai University of Sport</p>
                    <p>上海市杨浦区长海路399号 邮编：200438 总机：(86-21)51253000 沪ICP备05052054</p>
                </div>
            </div>
            <!-- 联系方式 -->
            <ul class="f-right">
                <h3>联系方式 </h3>
               <!-- 20160625 修改联系方式 START -->
                <li><i class="icon icon-phone"></i> 电话：51253516，51253517</li>
                <li><i class="icon icon-phone"></i> 传真：51253518</li>
                <li><i class="icon icon-tag"></i> 地址：绿瓦大楼229室</li>
                <li><i class="icon icon-tag"></i> 邮箱：<a href="email:jfzx@sus.edu.cn">jfzx@sus.edu.cn</a></li>
                <!-- 20160625 修改联系方式 END --> 
            </ul>
        </div>
    </div>