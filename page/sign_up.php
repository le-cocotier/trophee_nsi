<!-- Form cible >> cible/sign_in.php
Il faut 4 fields:
    - name
    - password
    - email
    - birth_date -->
<!DOCTYPE html>
<html>
    <body>
        <form action="../cible/sign_up.php" method="post">
            <h1>username</h1>
            <input type="text" name="name">
            <h1>email</h1>
            <input type="email" name="email">
            <h1>birth_date</h1>
            <input type="date" name="birth_date">
            <h1>password</h1>
            <input type="password" name="password">
            <input type="submit" value="sign up">

        </form>
    </body>
</html>
