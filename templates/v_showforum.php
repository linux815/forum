<?php/** * Шаблон главной страницы * ======================= * */?><?php if ($user[0] <> 0): {?><a href="index.php?c=addthread&id=<?= $_GET['id'] ?>">Добавить тему</a></div></div><?php }endif; ?><?php if ($user[0] <> 0): { ?><a href="index.php?c=add&id=<?= $_GET['id'] ?>">Добавить раздел</a></div></div><?php }endif; ?><?php  if (($array_forums[0] == 0 or $array_forums[0] == "")): echo ""; else: {?><div class="borderwrap" style="display:" id="fo_1">  <table class='ipbtable' cellspacing="1">    <tr>      <th colspan="2" width="66%">Форум</th>      <th style='text-align:center' width="7%">Тем</th>      <th style='text-align:center' width="7%">Ответов</th>      <th width="35%">Последнее сообщение</th>    </tr>    <?php if (!isset($_GET['jh'])): { foreach ($array_forums as $row): ?>    <tr>      <td align="center" class="row2" width="1%"><img src='images/<?= $row['icon_img'] ?>' border='0'  /></td>      <td class="row2">        <b><a href="index.php?c=showforum&id=<?= $row['id_forums'] ?>&page=1"><?= $row['forum_name'] ?></a></b>        <br />        <span class="forumdesc"><?= $row['description'] ?><br />          <?php if ($user[0] <> 0): {?>          <a href="index.php?c=confirm&id=<?= $_GET['id'] ?>&forum=<?= $row['id_forums'] ?>">Удалить</a> | <a href="index.php?c=edit&forum=<?= $row['id_forums'] ?>">Редактировать</a>          <?php }endif; ?>        </span>      </td>      <td align="center" class="row1"><?= $row['threads_quantity'] ?></td>      <td align="center" class="row1"><?= $row['posts_quantity'] ?></td>      <?php if ($row['last_author'] == ""):?><td class="row1" nowrap="nowrap"><span>Сообщений нет...<br /><b></b></span></td>      <?php else: { ?>      <td class="row1" nowrap="nowrap"><span><?= $row['last_post'] ?><br /><b>Автор:</b><?= $row['last_author'] ?></span></td>      <?php }endif;?>    </tr>    <?php endforeach; } endif;?>  </table>  <?php } endif;?>  <div class="borderwrap" style="display:" id="fo_1">    <?php if ($array_threads == ""): echo "Тем нет"; else: {?>    <table class='ipbtable' cellspacing="1">      <tr>        <th colspan="2" width="66%">Название темы</th>        <th style='text-align:center' width="7%">Ответов</th>        <th style='text-align:center' width="7%">Автор</th>        <th style='text-align:center' width="7%">Просмотров</th>        <th width="35%">Последнее сообщение</th>      </tr>      <?php if (!isset($_GET['showforum'])): { if ($posts[0] <> 0): { foreach ($array_threads as $row=>$key): ?>      <tr>        <td align="center" class="row2" width="1%"><img src='images/norm.gif' border='0' /></td>        <td class="row2">          <b><a href="index.php?c=showmessage&forums=<?= $_GET['id'] ?>&id=<?= $key['id_thread'] ?>&page=1"><?= $key['thread_name'] ?></a></b>          <br />          <span class="forumdesc"><?= $key['description'] ?><br />            <?php if ($user[0] <> 0): {?>            <a href="index.php?c=confirm&id=<?= $key['forum_id'] ?>&thread=<?= $key['id_thread'] ?>">Удалить</a> | <a href="index.php?c=editthread&thread=<?= $key['id_thread'] ?>">Редактировать</a>            <?php } endif;?>          </span>        </td>        <td align="center" class="row1"><?= $key['posts_quantity'] ?></td>        <td align="center" class="row1"><?= $key['name'] ?></td>        <td align="center" class="row1"><?= $key['hits_quantity'] ?></td>        <td class="row1" nowrap="nowrap"><span><?php if ($key['last_post']=="0000-00-00 00:00:00") echo $key['date']; else echo $key['last_post'];?><br /><b><b>Автор:</b> <?php if ($key['last_author']=="") echo $key['name']; else echo $key['last_author'];?></span></td>      </tr>      <?php endforeach; } endif; } endif; ?>    </table>    <?php } endif; ?>    <?php if (($page == 1) and($nextpage == "")) echo ""; else echo " ".$pervpage.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$nextpage; ?>