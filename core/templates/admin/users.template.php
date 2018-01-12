<style>
    .box {
        width: 90%;
        margin-right: 1em;
    }

    table {
        width: 100%;
    }

    th {
        padding-bottom: 0.2em;
        font-size: 1.2em;
        border-bottom: 1px solid #333;
    }

    tr:nth-child(2n) {
        background-color: #eee;
    }

    td {
        padding: 0.5em 0em;
    }

    th, td {
        text-align: center;
    }
</style>

<div class="page">
    <h1>Users</h1>
    <div class="row">
        <div class="box">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Onlinetime</th>
                    <th>Planetid</th>
                </tr>
                {userlist}
            </table>
        </div>
    </div>
