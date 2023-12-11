<div class="container">
    <div class="w-100 col-12 col-lg-10 col-xl-8 col-xxl-6 mx-auto border border-3 border-primary mt-5 p-2 ">

    <table class="table table-striped table-hover m-0">
  <thead>
    <tr>
      <th scope="col">Pseudo</th>
      <th scope="col">Actif ?</th>
      <th scope="col">Role</th>
      <th scope="col">Email</th>
      <th scope="col">Suppression</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($infoUsers as $user) : ?>
                <tr>
                    <td>
                        <p><?= $user['login'] ?></p>
                    </td>
                    <td>
                        <?php if ($user['role'] !== "admin") : ?>
                           
                            <form action="<?= URL ?>administrator/modify_state" method="POST">
                                <input type="hidden" name="login" value="<?= $user['login'] ?>">
                                <select name="is_valid" name="is_valid" onchange="confirmation(this.form)">
                                    <option value=1 <?= $user['is_valid'] === 1 ? "selected" : "" ?>>actif</option>
                                    <option value=0 <?= $user['is_valid'] === 0 ? "selected" : "" ?>>suspendu</option>
                                </select>
                            </form>
                            <?php else : ?>
                                <p>Toujours !</p>
                        <?php endif ?>
                    </td>
                    <td>
                        <?php if ($user['role'] === "admin") : ?>
                            <p><?= $user['role'] ?></p>
                        <?php else : ?>
                            <form action="<?= URL ?>administrator/modify_role" method="POST">
                                <input type="hidden" name="login" value="<?= $user['login'] ?>">
                                <select name="role" name="role" onchange="confirmation(this.form)">
                                    <option value="user" <?= $user['role'] === "user" ? "selected" : "" ?>>Utilisateur</option>
                                    <option value="admin" <?= $user['role'] === "admin" ? "selected" : "" ?>>Administrateur</option>
                                </select>
                            </form>
                        <?php endif ?>

                    </td>
                    <td>
                        <p><?= $user['mail'] ?></p>
                    </td>
                    <td>
                    <?php if ($user['role'] !== "admin") : ?>
                        <form action="<?= URL ?>administrator/delete_account_user" method="post">
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer => <?= $user['login'] ?> ?')">
                                Supprimer</button>
                            <input type="hidden" name="login" value="<?= $user['login'] ?>">
                        </form>
                        <?php else : ?>
                                <p>Impossible</p>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
  </tbody>
</table>




    </div>
</div>