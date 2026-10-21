<?php
include('conn.php');

$sql = "SELECT * FROM Keygen_Links WHERE id = 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current8BPLink = $row["8BP_Link"];
    $currentCODMLink = $row["CODM_Link"];
    $currentFL84Link = $row["FL84_Link"];
    $currentMLBBLink = $row["MLBB_Link"];
    $currentPUBGLink = $row["PUBG_Link"];
} else {
    echo "No results from database.";
}
?>

<?= $this->extend('Layout/Starter') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center pt-3">
    <div class="col-lg-8"></div>
    <div class="col-lg-8 mb-3">
        <div class="card mb-5">
            <div class="card-header p-3 bg-dark text-white">
                Edit Link
                <div class="col text-end">
                    <a class="btn btn-sm btn-outline-light" href="ManageShortenerLinks" class="py-1 px-2 bg-white text-muted"><i class="bi bi-arrow-left"></i></a>
                </div>
            </div>
            <div class="card-body">
                <form action="Edit_Keygen_Links.php" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="8bp_link" class="form-label">8BP Link</label>
                            <input type="text" name="8bp_link" id="8bp_link" class="form-control" placeholder="" aria-describedby="help-8bp_link" value="<?php echo $current8BPLink; ?>">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="codm_link" class="form-label">CODM Link</label>
                            <input type="text" name="codm_link" id="codm_link" class="form-control" placeholder="" aria-describedby="help-codm_link" value="<?php echo $currentCODMLink; ?>">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label for="fl84_link" class="form-label">FL84 Link</label>
                            <input type="text" name="fl84_link" id="fl84_link" class="form-control" placeholder="" aria-describedby="help-fl84_link" value="<?php echo $currentFL84Link; ?>">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="mlbb_link" class="form-label">MLBB Link</label>
                            <input type="text" name="mlbb_link" id="mlbb_link" class="form-control" placeholder="" aria-describedby="help-mlbb_link" value="<?php echo $currentMLBBLink; ?>">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="pubg_link" class="form-label">Pubg Link</label>
                            <input type="text" name="pubg_link" id="pubg_link" class="form-control" placeholder="" aria-describedby="help-pubg_link" value="<?php echo $currentPUBGLink; ?>">
                        </div>
                        <div class="col-md-12 mt-2">
                            <button type="submit" class="btn btn-outline-dark">Update Link</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>

<?= $this->endSection() ?>