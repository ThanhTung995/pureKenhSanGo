<div class="tab_thong_so_ky_thuat">
    <?php
    $tab_thong_so_ky_thuat = get_field('tab_thong_so_ky_thuat');
    if(!empty($tab_thong_so_ky_thuat)) :
    ?>
    <ul>
        <?php
            foreach ($tab_thong_so_ky_thuat as $item) :
                if(!empty($item['title'])) {
        ?>
        <li>
            <div class="title">
                <?php echo $item['title']; ?>
            </div>
            <div class="content">
                <?php if(!empty($item['content'])){ echo $item['content']; } ?>
            </div>
        </li>
        <?php
            }
        endforeach;
        ?>
    </ul>
    <?php
    endif;
    ?>
</div>