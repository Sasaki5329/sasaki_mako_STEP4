<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: form.php');
    exit;
}

$name = htmlspecialchars($_POST['name'] ?? '', ENT_QUOTES, 'UTF-8');
$age = htmlspecialchars($_POST['age'] ?? '', ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars($_POST['phone'] ?? '', ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8');
$address = htmlspecialchars($_POST['address'] ?? '', ENT_QUOTES, 'UTF-8');
$question = htmlspecialchars($_POST['question'] ?? '', ENT_QUOTES, 'UTF-8');
$gender = htmlspecialchars($_POST['gender'] ?? '', ENT_QUOTES, 'UTF-8');

$errors = [];

// 名前：ひらがな・カタカナ・漢字・英字のみ
if (!preg_match('/^[ぁ-んァ-ヶ一-龠a-zA-Z]+$/u', $name)) {
    $errors[] = "名前はひらがな・カタカナ・漢字・英字のみで入力してください。";
}

// 年齢：0〜150
if (!filter_var($age, FILTER_VALIDATE_INT) || $age < 0 || $age > 150) {
    $errors[] = "年齢は0〜150の範囲で入力してください。";
}

// 電話番号：半角数字とハイフンのみ
if (!preg_match('/^[0-9-]+$/', $phone)) {
    $errors[] = "電話番号は半角数字とハイフンのみで入力してください。";
}

// メールアドレス：形式チェック
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "メールアドレスの形式が正しくありません。";
}

// 住所：ひらがな・カタカナ・漢字・英字・半角数字・ハイフンのみ
if (!preg_match('/^[ぁ-んァ-ヶ一-龠a-zA-Z0-9-]+$/u', $address)) {
    $errors[] = "住所はひらがな・カタカナ・漢字・英字・半角数字・ハイフンのみで入力してください。";
}

if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
    echo "<p><a href='form.php'>戻る</a></p>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>確認画面</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>確認画面</h1>
    <form action="complete.php" method="post">
        <dl>
            <dt>名前：</dt>
            <dd><?= $name ?></dd>
            <dt>年齢：</dt>
            <dd><?= $age ?></dd>
            <dt>電話番号：</dt>
            <dd><?= $phone ?></dd>
            <dt>メールアドレス：</dt>
            <dd><?= $email ?></dd>
            <dt>住所：</dt>
            <dd><?= $address ?></dd>
            <dt>質問内容：</dt>
            <dd><?= nl2br($question) ?></dd>
            <dt>性別：</dt>
            <dd><?= $gender ?></dd>
        </dl>

        <input type="hidden" name="name" value="<?= $name ?>">
        <input type="hidden" name="age" value="<?= $age ?>">
        <input type="hidden" name="phone" value="<?= $phone ?>">
        <input type="hidden" name="email" value="<?= $email ?>">
        <input type="hidden" name="address" value="<?= $address ?>">
        <input type="hidden" name="question" value="<?= $question ?>">
        <input type="hidden" name="gender" value="<?= $gender ?>">

        <button type="button" onclick="history.back()">戻る</button>
        <button type="submit">送信</button>
    </form>

</body>
</html>
