<?php
use yii\helpers\Html;
use yii\helpers\Url;

$moths_rus = array(
        'January' => 'Январь',
        'February' => 'Февраль',
        'March' => 'Март',
        'April' => 'Апрель',
        'May' => 'Май',
        'June' => 'Июнь',
        'July' => 'Июль',
        'August' => 'Август',
        'September' => 'Сентябрь',
        'October' => 'Октябрь',
        'November' => 'Ноябрь',
        'December' => 'Декабрь',
    );
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3" >
            <div class="calendar hidden-xs hidden-sm" style="width: 80%; height: 300px; margin: 0 auto;">
                <div class="monthName"><?= $moths_rus[date('F')] ?></div>
                <div class="calendBody">
                    <?php
                    $arraySpecials = array();
                    $month = date('F');
                    foreach ($posts as $post):
                        if (date('F', strtotime($post->timestamp)) != $month) {
                            continue;
                        }
                        if (date('d', strtotime($post->timestamp))[0] == '0') {
                            $dayOfPost = str_replace('0', '', date('d', strtotime(
                                $post->timestamp)));
                        } else {
                            $dayOfPost = date('d', strtotime($post->timestamp));
                        }
                        $arraySpecials[$dayOfPost][$post->id] = $post->title;
                    endforeach;

                    echo draw_calendar(8, 2017, $fillSpaces = true, $specials = $arraySpecials); ?>
                </div>
            </div>
            <div class="tags hidden-xs hidden-sm" style="width: 40%; height: 300px; margin: 0 auto; background-color: #ccc;">Тэги</div>
        </div>
        <div class="hidden-xs hidden-sm col-md-9 col-lg-9" >
            <div class="posts" style="height: 570px;">
                <?php
                $array = array('large', 'small', 'large', 'small', 'large');
                $i = -1;
                $j = 0;
                shuffle($array);
                if (count($posts) >= 7) {
                    array_splice($posts, 7, 0, '123');
                };
                ?>
                <div class="postRow">
                    <?php foreach ($posts as $post):
                    $i++;
                    if ($i == 5) {
                        $i=0;
                        $j++;
                        echo('</div><div class="postRow">');
                        shuffle($array);
                        if ($j == 1) {
                            $array = ['large', 'large', 'small', 'large', 'small'];
                        }
                    }
                    if ($i==2 and $j==1) {
                        echo("<div class=\"postImg small\"><img src=\"img\\rabbit.png\" \\></div>");

                    } elseif ($i < 5) {
                    echo("<div class=\"post $array[$i]\" data-id=\"$post->id\" >");

                    ?>
                    <div class="newTypeWrapper">
                        <div class="postNew">
                            <?php
                            $time = new \DateTime('now');
                            $today = $time->format('Y-m-d');
                            if ($post->timestamp >= $today) {echo 'new!';} ?>
                        </div>
                        <div class="postType" data-type=<?= Html::encode("{$post->type}") ?>></div>
                    </div>
                    <div class="postTitle"><a href="<?= Url::to(['post/view', 'id' => $post->id]) ?>"><?= $post->title ?></a></div>
                    <div class="postContent"><?= substr($post->content, 0, strpos($post->content, ' ', 150)); ?></div>
                    <div class="postViews"><img src="/img/pic/views.png" /><?php echo($post->views); ?></div>
                    <div class="postCommentsQuan"><img src="/img/pic/comment.png" />
                        <?php echo($post->commentsQuan);?>
                    </div>
                </div>
            <?php
            } endforeach; ?>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 hidden-md hidden-lg" style="height: 400px; background-color: #eee;">
            Слайдер с постами для мобильников
        </div>
    </div>
</div></div>