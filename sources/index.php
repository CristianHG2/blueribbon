<script>
        var stopSlider;

    jQuery(document).ready(function ($) {
        
        var jssor_1_options = {
          $AutoPlay: true,
          $SlideDuration: 800,
          $SlideEasing: $Jease$.$OutQuint,
          $ArrowNavigatorOptions: {
            $Class: $JssorArrowNavigator$
          },
          $BulletNavigatorOptions: {
            $Class: $JssorBulletNavigator$
          }
        };
        
        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

        stopSlider = function()
        {
            $Pause();
        }
        
        //responsive code begin
        //you can remove responsive code if you don't want the slider scales while window resizes
        function ScaleSlider() {
            var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
            if (refSize) {
                refSize = Math.min(refSize, 1920);
                jssor_1_slider.$ScaleWidth(refSize);
            }
            else {
                window.setTimeout(ScaleSlider, 30);
            }
        }
        ScaleSlider();
        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);
        //responsive code end
    });
</script>
<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1300px; height: 300px; overflow: hidden; visibility: hidden;">
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('resources/img/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
            <div>
                <div style="width: 100%; height: 500px; background-image: url('resources/img/slider1.jpg'); background-size: cover; background-position: center;"></div>
            </div>
            <div>
                <div style="width: 100%; height: 500px; background-image: url('resources/img/slider2.jpg'); background-size: cover; background-position: center;"></div>
            </div>
            <div>
                <div style="width: 100%; height: 500px; background-image: url('resources/img/slider3.jpg'); background-size: cover; background-position: center;"></div>
            </div>
        </div>

        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:6px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora22l" style="top:123px;left:12px;width:40px;height:58px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora22r" style="top:123px;right:12px;width:40px;height:58px;" data-autocenter="2"></span>
</div>
<div class="bContainer">

<div style="text-align: right;">
<h1>What is bullying?</h1>

Bullying is a modern form of peer pressure in which fellow students or coworkers are put into a state constant harrassment either by physical or verbal abuse. Bullying is generally most common in academic institutions, generally starting early in middle school and ending late in college after the maturity of most bullies is reached.<br><br>

Bullying has become an epidemic lately, with hundreds of kids being bullied and some even being driven to commit self harm, skip school or in some extreme cases, run away or commit suicide. This is something that we can avoid.<br><br>

This is why we've created Blue Ribbon.
</div>

<h1 style="text-align: left">How has bullying affected us?</h1>
<div id="indexCont"><div style="text-align: left;">Bullying is a serious issue in many schools that can have numerous negative effects on people.<br><Br> There

are over 3.2 million students who are victims of bullying each year and because of bullying

approximately 160,000 of them will skip out school just to avoid being bullied.<br><br> The worst part

about bullying is that many teachers are oblivious to the action, 1 in every 4 teachers see nothing

wrong with bullying and will only intervene 4% of the time. Sometimes people may not see it as

bullying and will simply say that there just playing with you or they want to be your friend.</div><br><br>

<div style="text-align: right;">
<h1>How can I help stop bullying?</h1>

There are many ways to avoid bullying: in schools, states have created laws against bullying, there also hundreds of organizations that are committed to stopping the crime that is bullying. Some of the things these organizations have done to prevent bullying is engaging with parents and children to work together towards a bully-free future. It is important for the people in the community to work amongst each other to send a unified message to prevent bullying. Make sure people know what bullying is by using something such as an awareness campaign. You can also establish a school safety committee to plan, enforce and evaluate the school's bullying rules.<br><br>

Here's a list of things you can do to help get rid of bullying in your community:<Br><Br>

<ul>
<li>Contact your school administrators if you see bullying</li>
<li>Talk with local authorities about anti bullying programs</li>
<li>Discuss with student government about solutions</li>
<li>Help fellow students that are being bullied or peer pressured</li>
</ul>
</div>
</div>

    <div class="fixedButtons">
        <div style="text-align: center;">
            <button id="joinComm">Join the community</button>
            <button id="moreInfo">More information</button>

            <script>

            $("#joinComm").click(function()
            {
                window.location.href = 'login.php';
            });

            $("#moreInfo").click(function()
            {
                window.location.href = 'about.php';
            });

            </script>
        </div>
    </div>
</div>