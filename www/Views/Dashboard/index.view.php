<div class="row">

    <?php
    $variable = [
        [
            'table' => 'Category', 'link' => 'category',
            'activated' =>  count($categoryActivated), 'pending' => count($categoryPending),
            'total' => count($categoryPending) + count($categoryActivated),
            'color' => 'primary'
        ],
        [
            'table' => 'Post', 'link' => 'post',
            'activated' =>  count($postActivated), 'pending' => count($postPending),
            'total' => count($postPending) + count($postActivated),
            'color' => 'success'
        ],
        [
            'table' => 'Menu', 'link' => 'menu',
            'activated' =>  count($menuActivated), 'pending' => count($menuPending),
            'total' => count($menuPending) + count($menuActivated),
            'color' => 'warning'
        ],
        [
            'table' => 'User', 'link' => 'user',
            'activated' =>  count($users), 'pending' => count($usersPending),
            'total' => count($users) + count($usersPending),
            'color' => 'danger'
        ],
    ];
    // var_dump(count($users));
    foreach ($variable as $key => $value) {
    ?>
        <style>
            .card-body p {
                color: gray;
            }
        </style>
        <div class="col-sm-4">
            <div class="card support-bar overflow-hidden">
                <a href="/admin/<?php echo $value['link']; ?>/index">
                    <div class="card-body pb-0">
                        <h2 class="text-<?php echo $value['color']; ?>"><?php echo $value['table']; ?> Table</h2>
                        <p class="mb-3 mt-3">Total data</p>
                    </div>
                    <div class="card-footer bg-<?php echo $value['color']; ?> text-white">
                        <div class="row text-center">
                            <div class="col">
                                <h4 class="m-0 text-white"><?php echo $value['total'] ?></h4>
                                <span>All</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white"><?php echo $value['activated']  ?></h4>
                                <span>Activated</span>
                            </div>
                            <div class="col">
                                <h4 class="m-0 text-white"><?php echo $value['pending']  ?></h4>
                                <span>Pending</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>
</div>