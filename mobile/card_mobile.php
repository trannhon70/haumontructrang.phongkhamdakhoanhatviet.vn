<div class="health_mobile_khoa">
        <?php
        if ($sessionkhoa === 'nam-khoa') {
            echo 'nam khoa';
        } elseif ($sessionkhoa == 'da-lieu') {
            echo 'da liễu';
        } elseif ($sessionkhoa == 'benh-xa-hoi') {
            echo 'bệnh xã hội';
        } elseif ($sessionkhoa == 'hau-mon-truc-trang') {
            echo 'hậu môn - trực tràng';
        }
        ?> </span>
    </div>
    <div class="health_mobile_benh">
        <?php
        if ($sessionkhoa === 'nam-khoa') {
            foreach ($MenuNamkhoa as $item) {
                if ($item['id'] === $sessionBenh) {
                    echo $item['title'];
                }
            }
        } elseif ($sessionkhoa === 'da-lieu') {
            foreach ($MenuDaLieu as $item) {
                if ($item['id'] === $sessionBenh) {
                    echo $item['title'];
                }
            }
        } elseif ($sessionkhoa === 'benh-xa-hoi') {
            foreach ($MenuBXH as $item) {
                if ($item['id'] === $sessionBenh) {
                    echo $item['title'];
                }
            }
        } elseif ($sessionkhoa === 'hau-mon-truc-trang') {
            foreach ($MenuHM as $item) {
                if ($item['id'] === $sessionBenh) {
                    echo $item['title'];
                }
            }
        }
        ?>
    </div>
    <div class="health_mobile_body">
        <?php if ($list_BV_pagination) : ?>
            <?php while ($result = $list_BV_pagination->fetch_assoc()) : ?>
                <div class="health_mobile_body_card">
                    <div class="health_mobile_body_card_left">
                        <img src="<?php echo $local ?>/admin/uploads/<?php echo $result['img'] ?>" alt="...">
                    </div>
                    <div class="health_mobile_body_card_right">
                        <div class="health_mobile_body_card_right_title"> <?php echo $result['tieu_de']; ?> </div>
                        <div class="health_mobile_body_card_right_footer">
                            <a class="health_mobile_body_card_right_footer_left" href="#">
                                hỏi bác sĩ
                            </a>
                            <a class="health_mobile_body_card_right_footer_right" href="<?php echo $local ?>/<?php echo $sessionkhoa ?>/<?php echo $result['slug'] ?>.html">chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <div>
                <div class="health_row_col_footer_pagi">
                    <?php if ($page > 1) : ?>
                        <a onclick="setPageBaiViet('<?php echo $page - 1; ?>'); return true;" href="<?php echo $local ?>/<?php echo $khoa ?>/<?php echo $sessionBenh ?>.html" class="health_row_col_footer_pagi_prev">
                            <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path fill="white" d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z" />
                            </svg>
                        </a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <a onclick="setPageBaiViet('<?php echo $i; ?>'); return true;" href="<?php echo $local ?>/<?php echo $khoa ?>/<?php echo $sessionBenh ?>.html" class="health_row_col_footer_pagi_number <?php if ($i == $page) echo 'health_row_col_footer_pagi_number_active'; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages) : ?>
                        <a onclick="setPageBaiViet('<?php echo $page + 1; ?>'); return true;" href="<?php echo $local ?>/<?php echo $khoa ?>/<?php echo $sessionBenh ?>.html" class="health_row_col_footer_pagi_next">
                            <svg width="30" height="30" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                                <path fill="white" d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z" />
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php else : ?>
            <div class="no-pagination">
                Không có dữ liệu bài viết để hiển thị.
            </div>
        <?php endif; ?>
    </div>

    <div style="width: 100%;" >
        <img width="100%" src="<?php echo $local ?>/images/logo_mobile/bg_mobile_km.gif" alt="">
    </div>