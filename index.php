<?php

function getResult($var)
{
    if (!empty($var['submit']))
        if ($res = eval($var['code']))
            return $res;
}

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="style.css" />
        <title>PHP editor</title>
    </head>
    <body>
        <div id="codeArea">
            <legend>Code:</legend>
            <form action="" method="post">
                <input type="hidden" name="submit" value="<?php echo uniqid(); ?>" />
                <textarea name="code" id="codeTxt"><?php if (isset($_POST['code'])) echo $_POST['code']; ?></textarea>
                <input type="checkbox" name="pre" id="preChk" <?php echo (isset($_POST['pre']) ? 'checked="checked"' : ''); ?> /><label for="preChk">PREFORMATTED</label>
                <br />
                <input type="submit" value="RUN" />
                <input type="button" value="UNDO" id="undoBtn" />
                <input type="button" value="CLEAR" id="clearBtn" />
            </form>
        </div>
        
        <div id="resultArea">
            <legend>Result:</legend>
            <?php if (isset($_POST['pre'])) { ?>
                <textarea readonly="readonly"><?php echo getResult($_POST); ?></textarea>
            <?php } else { ?>
                <div id="resultTxt"><?php echo getResult($_POST); ?></div>
            <?php } ?>
        </div>
        
        <script type="text/javascript">
            document.getElementById('undoBtn').onclick = function () {
                if (confirm('Are you sure ?'))
                    this.form.reset();
            }
            document.getElementById('clearBtn').onclick = function () {
                if (confirm('Are you sure ?'))
                    document.getElementById('codeTxt').innerHTML = '';
            }
        </script>
    </body>
</html>
