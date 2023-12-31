<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>ADD <?php echo strtoupper(explode('/', $_SERVER['REQUEST_URI'])[2]); ?></h5>
            </div>
            <div class="card-body">
                <form action="" method="<?php echo $form['config']['method'] ?>">
                    <div class="row">
                        <?php foreach ($form['groups'] as $key => $value) : ?>
                            <?php if ($value['elements']['type'] == "select") : ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-label"><?php echo $value['labels']['title']; ?></label>
                                        <select class="form-control" name="<?php echo $key; ?>">
                                            <!-- <label value="0">Choose</label> -->
                                            <?php foreach ($value['elements']['options'] as $option) : ?>
                                                <option value="<?php echo $option['value']; ?>" <?php echo $option['selected']; ?>><?php echo $option['title']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            <?php elseif ($value['elements']['type'] == "textarea") : ?>
                                <div class="col-md-<?php echo $value['elements']['col']; ?>">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <?php echo $value['labels']['title']; ?>
                                        </label>
                                        <textarea class="form-control" name="<?php echo $key; ?>" id="<?php echo $key; ?>" rows="2" min="<?php echo $value['elements']['min']; ?>" max="<?php echo $value['elements']['max']; ?>"><?php echo $value['elements']['value']; ?></textarea>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="col-md-<?php echo $value['elements']['col']; ?>">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <?php echo $value['labels']['title']; ?>
                                        </label>
                                        <input type="<?php echo $value['elements']['type']; ?>" class="form-control" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value['elements']['value']; ?>" <?php if ($value['elements']['event'] == 'onkeyup') { ?> onkeyup="to_slug('title', 'slug')" <?php } ?> <?php echo $value['elements']['required']; ?> placeholder="<?php echo $value['labels']['title']; ?>"  min="<?php echo $value['elements']['min']; ?>" max="<?php echo $value['elements']['max']; ?>">
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-outline-primary has-ripple">
                        Save
                    </button>
                    <a href="/admin/<?php echo explode('/', $_SERVER['REQUEST_URI'])[2] . '/' . $form['config']['cancel'] ?>" class="btn btn-outline-secondary has-ripple">
                        Exit
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>