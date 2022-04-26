<div class="mt-4 mb-4">
    <h3 class="text-center">List of Business Cards:</h3>
</div>
<?php if (empty($businessCards)): ?>
    <div class="row d-flex align-items-start justify-content-center "> No result...</div>
<?php else: ?>
    <div class="row d-flex align-items-start justify-content-center ">
        <?php foreach ($businessCards as $businessCard): ?>
            <div class="business-card-container mt-6">
                <div class="card flex-fill">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-11">
                                <div class="bg-effects">
                                    <h5 class="card-title">
                                        <?php echo
                                        ($businessCard['name'] && $businessCard['surname']) ?
                                            $businessCard['name'] . " " . $businessCard['surname'] : ""
                                        ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo $businessCard['position'] ?? "" ?>
                                    </p>
                                </div>
                                <ul>
                                    <?php foreach ($businessCard as $key => $value): ?>
                                        <?php if ($key == "id" || $key == "created_at") {
                                            continue;
                                        } ?>
                                        <?php if ($key == "hired" && $value == 0) {
                                            $value = "no";
                                        } ?>
                                        <?php if ($key == "hired" && $value == 1) {
                                            $value = "yes";
                                        } ?>
                                        <li><?php echo $key ?> : <span><?php echo $value ?></span></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="bg-custom"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>