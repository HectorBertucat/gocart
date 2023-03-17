<hr>
<div>
    <div class="half right">
        <div class="bubble">
            <div class="row gtr-uniform">

                <div style="margin-top:-17px;" class="col-6">
                    <input id="datepickerTurnoverStart" type="date">
                </div>
                <div style="margin-top:-17px;" class="col-6">

                    <input id="datepickerTurnoverEnd" type="date">
                </div>
            </div>
            <h2 style="margin-bottom:10px;margin-top:25px">Chiffre d'affaire</h2>
            <h2 class="color_details" style="margin-bottom:0;font-size:36px" id="turnover"></h2>

        </div>
    </div>
    <div class="half">
        <div class="bubble">
            <select style="margin-top:-17px" name="cartStatus" id="cartStatus">
                <?php foreach ($cartStatus as $status) { ?>
                    <option value="<?php echo $status['id'] ?>"><?php echo $status['name'] ?></option>
                <?php } ?>
            </select>

            <h2 style="margin-bottom:10px;margin-top:25px">Chariots</h2>


            <h2 class="color_details" style="margin-bottom:0;font-size:36px" id="nbCarts"></h2>

        </div>
    </div>

</div>

<hr>
<h2 class="center">Statistiques</h2>

<div class="bubble">
    <div class="row gtr-uniform">

        <div class="col-4">
            <input id="datepicker" type="date">

        </div>

        <div class="col-4">
            <select name="article_type" id="article_type">
                <option value="0">Tous les articles</option>
                <?php foreach ($article_type as $type) { ?>
                    <option value="<?php echo $type['id'] ?>"><?php echo $type['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col-4">

            <select name="carts" id="carts">
                <option value="0">Tous les chariots</option>
                <?php foreach ($carts as $cart) { ?>
                    <option value="<?php echo $cart['id'] ?>"> Chariot n°<?php echo $cart['id'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>


<div>
    <div class="bubble half right">
        <div class="chart-container">
            <canvas id="sells_day_amount"></canvas>
        </div>
    </div>

    <div class="bubble half">
        <div class="chart-container">
            <canvas id="sells_hour_amount"></canvas>
        </div>
    </div>
</div>
<div>
    <div class="bubble half right">
        <div class="chart-container">
            <canvas id="sells_day_quantity"></canvas>
        </div>
    </div>
    <div class="bubble half">
        <div class="chart-container">
            <canvas id="sells_hour_quantity"></canvas>
        </div>
    </div>
</div>
<hr>