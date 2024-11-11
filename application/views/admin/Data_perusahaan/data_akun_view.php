<table id="datatable" class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
      <th>No.</th>
      <th>Nama Akun</th>
    </tr>
  </thead>
  <tbody>
  <?php $j = 1; ?>
    <?php foreach ($data_role as $role): ?>
      <tr>
        <td align="center"><?php echo $j ?></td>
        <td align="left"><?php echo $role->list ?></td>
      </tr>
      <?php $j++; ?>
    <?php endforeach; ?>
  </tbody>
</table>
