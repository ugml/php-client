<!-- content -->

<div class="row" id="page-content">

    {queue}

    <!--// ogame: countdown of same units
    // if different unit is next in the queue, reload the page-->

    <div class="col-md-12">
        <div class="row">
            <form action="game.php?page=shipyard" method="post">
                <div class="col-md-12 content-header">
                    {page}
                </div>
                <div class="col-md-12 content-body">
                    {shipyard_list}
                </div>
                <div class="col-md-12 content-header text-center">
                    <button>{build}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src=""></script>

<!--            <div id="page">-->
<!---->
<!--                <script src="scripts/cnt.js"></script>-->
<!---->
<!--                <style>-->
<!--                    .s_building {-->
<!--                        border:0.1em solid rgb(74,91,97);-->
<!--                        margin-bottom:1em;-->
<!--                    }-->
<!---->
<!--                    .s_building_title {-->
<!--                        box-sizing: border-box;-->
<!--                        padding: 0.5em 1em;-->
<!--                        font-size: 1.1em;-->
<!--                        font-weight: bold;-->
<!--                        border-bottom: 0.1em solid rgb(74,91,97);-->
<!--                    }-->
<!---->
<!--                    .buildable {-->
<!--                        background-color: rgba(100, 221, 23, 0.5);-->
<!--                        border: solid 1px rgba(104, 159, 56, 0.5);-->
<!--                        padding:0.5em;-->
<!--                        transition: box-shadow 0.3s, border 0.3s;-->
<!--                        color: #FAFAFA;-->
<!--                        margin:1em 0;-->
<!--                        width: 90%;-->
<!--                        box-sizing: border-box;-->
<!--                        -moz-box-sizing: border-box;-->
<!--                        -webkit-box-sizing: border-box;-->
<!--                    }-->
<!---->
<!--                    .buildable:hover {-->
<!--                        box-shadow: 0 0 5px 1px rgba(100, 221, 23, 0.5);-->
<!--                        background-color: rgba(100, 221, 23, 0.5);-->
<!--                        border: solid 1px rgba(104, 159, 56, 0.5);-->
<!--                        color: rgb(255,255,255);-->
<!--                        padding:0.5em;-->
<!--                        margin:1em 0;-->
<!--                        width: 90%;-->
<!--                        box-sizing: border-box;-->
<!--                        -moz-box-sizing: border-box;-->
<!--                        -webkit-box-sizing: border-box;-->
<!--                    }-->
<!---->
<!--                    .notBuildable {-->
<!--                        background-color: rgba(255, 97, 89, 0.5);-->
<!--                        border: solid 1px rgba(255, 35, 122, 0.5);-->
<!--                        padding:0.5em;-->
<!--                        transition: box-shadow 0.3s, border 0.3s;-->
<!--                        color: #FAFAFA;-->
<!--                        margin:1em 0;-->
<!--                        width: 90%;-->
<!--                        box-sizing: border-box;-->
<!--                        -moz-box-sizing: border-box;-->
<!--                        -webkit-box-sizing: border-box;-->
<!--                    }-->
<!--                </style>-->
<!---->
<!--                <div class="page_heading">-->
<!--                    {page}-->
<!--                </div>-->
<!---->
<!--                <div class="page_content">-->
<!--                    <form method="post">-->
<!--                        <div class="row">-->
<!--                            <div class="col-12 s_building_title">-->
<!--                                <button name="build" class="{s_build_class}">{build}</button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    {shipyard_list}-->
<!--                        <div class="row">-->
<!--                            <div class="col-12 s_building_title">-->
<!--                                <button name="build" class="{s_build_class}">{build}</button>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </form>-->
<!--                </div>-->
