<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Note List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Note</th>
		<th>Date</th>
		<th>Added</th>
		<th>Updated</th>
		<th>Id User</th>
		
            </tr><?php
            foreach ($note_data as $note)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $note->note ?></td>
		      <td><?php echo $note->date ?></td>
		      <td><?php echo $note->added ?></td>
		      <td><?php echo $note->updated ?></td>
		      <td><?php echo $note->id_user ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>