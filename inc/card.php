<?php


// Số bài viết trên mỗi trang
$limit = 5;
// Trang hiện tại
$page = Session::get('page') ? Session::get('page') : 1;

// Tính toán offset
$offset = ($page - 1) * $limit;

// Lấy danh sách bài viết theo phân trang
$list_BV_pagination = $bai_viet->getById_benh($benh, $limit, $offset);

// Lấy tổng số bài viết
$total_articles = $bai_viet->getTotalCountById($benh);
// Tính toán tổng số trang
$total_pages = ceil($total_articles / $limit);
?>


<style>
    .no-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        height: 500px;
    }
</style>
<div class="health_row_col_title">
    <span>
        <?php
        if ($sessionkhoa === 'nam-khoa') {
            foreach ($MenuNamkhoa as $item) {
                if ($item['id'] === $sessionBenh) {
                    echo $item['title'];
                    break;
                }
            }
        } elseif ($sessionkhoa === 'da-lieu') {
            foreach ($MenuDaLieu as $item) {
                if ($item['id'] === $sessionBenh) {
                    echo $item['title'];
                    break;
                }
            }
        } elseif ($sessionkhoa === 'benh-xa-hoi') {
            foreach ($MenuBXH as $item) {
                if ($item['id'] === $sessionBenh) {
                    echo $item['title'];
                    break;
                }
            }
        } elseif ($sessionkhoa === 'hau-mon-truc-trang') {
            foreach ($MenuHM as $item) {
                if ($item['id'] === $sessionBenh) {
                    echo $item['title'];
                    break;
                }
            }
        }
        ?>
    </span>
</div>
<?php if ($list_BV_pagination) : ?>
    <?php while ($result = $list_BV_pagination->fetch_assoc()) : ?>
        <?php
        $tieu_de = $result['tieu_de'];
        $descriptions = $result['descriptions'];
        // if (strlen($tieu_de) > 100) {
        //     $tieu_de = substr($tieu_de, 0, 100) . '...';
        // }
        // if (strlen($descriptions) > 155) {
        //     $descriptions = substr($descriptions, 0, 155) . '...';
        // }
        ?>
        <div class="health_row_col_card">
            <div class="health_row_col_card_left">
                <img style="border-radius: 20px;" width="154px" height="154px" src="<?php echo $local ?>/admin/uploads/<?php echo $result['img'] ?>" alt="...">
            </div>
            <div class="health_row_col_card_right">
                <div class="health_row_col_card_right_title"><?php echo $tieu_de; ?></div>
                <div class="health_row_col_card_right_text">
                    <?php echo $descriptions; ?>
                </div>
                <div style="display: flex;" class="health_row_col_card_right_footer">
                    <button class="health_row_col_card_right_footer_botton">hỏi bác sĩ</button>
                    <a href="<?php echo $local ?>/<?php echo $sessionkhoa ?>/<?php echo $result['slug'] ?>.html">
                        <button class="health_row_col_card_right_footer_botton1">chi tiết</button>
                    </a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>

    <div class="health_row_col_footer">
        <div class="health_row_col_footer_pagi">
            <?php if ($page > 1) : ?>
                <a onclick="setPageBaiViet('<?php echo $page - 1; ?>'); return true;" href="<?php echo $local ?>/<?php echo $khoa ?>/<?php echo $sessionBenh ?>.html" class="health_row_col_footer_pagi_prev">
                    <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path fill="white" d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                    </svg>
                </a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                <a onclick="setPageBaiViet('<?php echo $i; ?>'); return true;"  href="<?php echo $local ?>/<?php echo $khoa ?>/<?php echo $sessionBenh ?>.html" class="health_row_col_footer_pagi_number <?php if ($i == $page) echo 'health_row_col_footer_pagi_number_active'; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($page < $total_pages) : ?>
                <a onclick="setPageBaiViet('<?php echo $page + 1; ?>'); return true;"  href="<?php echo $local ?>/<?php echo $khoa ?>/<?php echo $sessionBenh ?>.html" class="health_row_col_footer_pagi_next">
                    <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path fill="white" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                    </svg>
                </a>
            <?php endif; ?>
        </div>

        <div class="health_row_col_footer_share">
            <div class="health_row_col_footer_share_text">
                hãy chia sẽ cùng chúng tôi
            </div>
            <div class="health_row_col_footer_share_icon">
                <img width="50px" height="50px" src="<?php echo $local ?>/images/icons/icon_zalo.webp" alt="">
                <img width="50px" height="50px" src="<?php echo $local ?>/images/icons/icon_fb.webp" alt="">
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="no-pagination">
        Không có dữ liệu bài viết để hiển thị.
    </div>
<?php endif; ?>