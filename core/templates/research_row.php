<div class="row">
    <div class="col-md-2 text-center vertical-center building-image">
        <div>
            <img src="{r_image}" alt="{r_name}"/>
        </div>
    </div>
    <div class="col-md-9">
        <div>
            <a href="?page=techtree&bid={r_id}">{r_name}</a> (Level {r_level})<br/>
            {r_description}<br/>
            {requirements}: {metal}: {r_metal} {crystal}: {r_crystal} {deuterium}: {r_deuterium}<br/>
            {construction_time}: {r_time}
        </div>
    </div>
    <div class="col-md-1 vertical-center build_{r_id}">
        <div>
            {r_build}
        </div>
    </div>
</div>
