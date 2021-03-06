<div id="ModalEditProeve" class="modal">
    <div class="modal-header" style="padding-left: 24px;">
        <h5> Bewerken</h5>
    </div>
    <div class="modal-content">
        <form method="POST">
            <label>Om een proef aan te passen voert u hier de wijziging in:</label>
            <i class="material-icons prefix tiny">mode_edit</i><label></label>
            <?php
            $error = '';
            $get_cohort = "SELECT * FROM cohort";
            $result_cohort = $conn->query($get_cohort);
            if ($result_cohort->num_rows > 0) {
                ?>
                <select name="selected_cohort" required>
                    <option selected="selected" disabled>Kies een Cohort</option>
                    <?php
                    while ($row_cohort = $result_cohort->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row_cohort["cohort_id"] ?>"><?php echo $row_cohort["cohort_jaar"] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php
            }
            ?>
            <input type="hidden" class="form-control" style="border-radius: 0;" name="proeve_id" id="proeve_id">
            <input type="text" class="form-control" style="border-radius: 0;" name="proeve_naam" id="proeve_naam" placeholder="Proeve naam">
            <button type="submit" name="edit_proeve_submit" class="btn btn-success" value="Opslaan">Opslaan</button>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn btn-success ">Sluiten</a>
        </form>
    </div>
</div>
<?php
if (isset($_POST['edit_proeve_submit'])){
    if (isset($_POST['selected_cohort'])){
        if (isset($_POST['proeve_naam'])){
            $edit_cohort_id = $_POST['selected_cohort'];
            $edit_proeve_naam = $_POST['proeve_naam'];
            $edit_proeve_sql = "UPDATE proeve SET proeve_naam = '$edit_proeve_naam', cohort_id = '$edit_cohort_id' WHERE proeve_naam = $edit_proeve_naam, cohort_id = $edit_cohort_id";
            // $edit_proeve = "UPDATE proeve SET proeve_naam='$edit_proeve_naam' WHERE proeve_id = $edit_proeve_id";
            echo "<meta http-equiv='refresh' content='0'>";
            if ($conn->query($edit_proeve_sql) === TRUE) {
                echo "Werkproces is toegevoegd";
            } else {
                echo "FOUTMELDING! Probeer opnieuw";
            }
        }
    }
}
if (!empty($error)){
    echo $error;
}

// if (isset($_POST["edit_proeve_submit"])) {
//     if (isset($_POST["proeve_naam"])) {
//         $edit_proeve_id = $_POST["proeve_id"];
//         $edit_proeve_naam = $_POST["proeve_naam"];
//         $edit_proeve = "UPDATE proeve SET proeve_naam='$edit_proeve_naam' WHERE proeve_id = $edit_proeve_id";
//         if ($conn->query($edit_proeve) === TRUE) {
//             //echo "Record updated successfully";
//         } else {
//             //echo "Error updating record: " . $conn->error;
//         }
//     }
// }
?>
