<div class="alert alert-light">
    <h1 class="alert-title">The knights game field</h1>
</div>

<div class="d-flex">
    <h5>Here are the started players : </h5><span class="ml-1"><i>(<?= count($knights) ?> players)</i></span>
</div>

<?php use App\Gamer\KnightGamer;

foreach ($knights as $knight) : ?>
    <strong><?= $knight->getName() ?></strong>
    <span>, </span>
<?php endforeach ?>

<br>

<p>All these players have <strong><?= KnightGamer::LIFE_POINT ?></strong> points </p>

<hr /><br>

<h5>Here is the winner of the game : </h5>

<span>Name: </span><strong><?= $winner->getName() ?></strong><br>
<span>With a score of: </span><strong><?= $winner->getPoints() ?> Points</strong>

<div class="text-center">
    <a href="/start-game" class="btn btn-success">New game</a>
</div>
