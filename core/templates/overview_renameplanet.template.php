<div id="page" class="box">
    <h1>{rename_or_abandon_planet}</h1>
    <form action="game.php?page=overview&mode=renameplanet" method="POST">
        <table width=519>
            <tr>
                <th>{name}</th><th>{coordinates}</th><th></th>
            </tr>
            <tr>
                <th>{planet_name}</th>
                <th>[{planet_galaxy}:{planet_system}:{planet_planet}]</th>
                <th></th>
            </tr>
            <tr>
                <th>{new_name}:</th>
                <th><input type="text" name="newname" size=25 maxlength=20></th>
                <th><input type="submit" name="rename" value="{rename}"></th>
            </tr>
            <tr>
                <th colspan="3"><input type="submit" name="abandon" value="{abandon}" alt="{abandon}"></th>
            </tr>
        </table>
    </form>
</div>
