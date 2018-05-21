<div class="row">
    <div class="col-md-2 text-center vertical-center building-image">
        <div>
            <img src="{b_image}" alt="{b_name}"/>
        </div>
    </div>
    <div class="col-md-9">
        <div>
            <a href="?page=techtree&bid={b_id}">{b_name}</a> ({level} {b_level})<br/>
            {b_description}<br/>
            {required_ressources} - {b_time}
        </div>
    </div>
    <div class="col-md-1 vertical-center build_{b_id}">
        <div>
            {b_build}
        </div>
    </div>
</div>
