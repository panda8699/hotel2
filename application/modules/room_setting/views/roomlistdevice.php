<div class="card">

    <div class="row">
        <!--  table area -->
        <div class="col-sm-12">
            <div class="card-body">
                <div class="table-responsive">
                    <table width="100%" id="exdatatable"
                        class="datatable table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th><?php echo display('sl_no') ?></th>
                                <th><?php echo display('floor_name'); ?></th>
                                <th><?php echo display('num_of_room'); ?></th>
                                <th><?php echo display('room_number'); ?></th>
                                <!-- <th><?php echo display('smart_lock_mac'); ?></th> -->
                                <th><?php echo display('smart_lock_url'); ?></th>
                                <!-- <th><?php echo display('lock_status'); ?></th> -->
                                <th><?php echo display('action'); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($floorplan)) {
                                ?>
                                <?php $sl = 1; ?>
                                <?php foreach ($floorplan as $type) { ?>
                                    <tr class="">
                                        <td><?php echo html_escape($type->floorplanid); ?></td>
                                        <td><?php echo html_escape($type->floorName); ?></td>
                                        <td><?php echo html_escape($type->noofroom); ?></td>
                                        <td><?php echo html_escape($type->roomno); ?></td>
                                        <!-- <td><?php echo html_escape($type->smart_lock_mac); ?></td> -->
                                        <td class="smart-lock-url-column"><?php echo html_escape($type->esp32_url); ?></td>

                                        <!-- <td>
                                            <label class="switch">
                                                <input type="checkbox" class="lock-status-switch"
                                                    data-mac="<?php echo html_escape($type->smart_lock_mac); ?>"
                                                    data-room="<?php echo html_escape($type->floorplanid); ?>"
                                                    <?php echo $type->lock_status ? 'checked' : ''; ?>
                                                    <?php echo (empty($type->smart_lock_mac) || empty($type->esp32_url)) ? 'disabled' : ''; ?>>
                                                <span class="slider round"></span>
                                            </label>
                                            <span class="lock-status-label"><?php echo $type->lock_status ? 'Lock' : 'Unlock'; ?></span>
                                        
                                            <span class="spinner-border spinner-border-sm text-primary lock-status-spinner" style="display: none;"></span>
                                        </td> -->

                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary edit-device-button"
                                                data-mac="<?php echo html_escape($type->smart_lock_mac); ?>"
                                                data-url="<?php echo html_escape($type->esp32_url); ?>"
                                                data-floorplanid="<?php echo html_escape($type->floorplanid); ?>">
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-sm btn-primary edit-device-button-1"
                                                data-mac="<?php echo html_escape($type->smart_lock_mac); ?>"
                                                data-url="<?php echo html_escape($type->esp32_url); ?>"
                                                data-floorplanid="<?php echo html_escape($type->floorplanid); ?>">
                                                Edit Device
                                            </button>
                                        </td>


                                    </tr>
                                    <?php $sl++; ?>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editDeviceModal" tabindex="-1" aria-labelledby="editDeviceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDeviceModalLabel">Edit Smart Lock</h5>
            </div>
            <div class="modal-body">
                <form id="editDeviceForm">
                    <!-- <div class="mb-3">
                        <label for="mac_address" class="form-label">Smart Lock MAC Address</label>
                        <input type="text" class="form-control" id="mac_address" name="mac_address">
                    </div> -->
                    <div class="mb-3">
                        <label for="esp32_url" class="form-label"><?php echo display('smart_lock_url'); ?></label>
                        <input type="text" class="form-control" id="esp32_url" name="esp32_url">
                    </div>
                    <input type="hidden" id="floorplan_id" name="floorplan_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btn-close" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveDeviceButton">Save changes</button>
            </div>
        </div>
    </div>
</div>


<style>
    .smart-lock-url-column {
        max-width: 150px;
        /* Set the desired max width */
        white-space: nowrap;
        /* Prevent text from wrapping */
        overflow: hidden;
        /* Hide overflowed text */
        text-overflow: ellipsis;
        /* Add ellipsis for overflowed text */
    }

    td {
        vertical-align: left;
        text-align: left;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 34px;
        height: 20px;
        vertical-align: middle;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 20px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 12px;
        width: 12px;
        border-radius: 50%;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:checked+.slider:before {
        transform: translateX(14px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<script src="<?php echo MOD_URL . $module; ?>/assets/js/floorPlanList.js"></script>
<script>
    document.querySelectorAll('.edit-device-button-1').forEach(button => {
        button.addEventListener('click', function () {
            const url = this.getAttribute('data-url');
            if (isValidUrl(url)) {
                console.log("🚀 ~ button.addEventListener ~ url:", url)
                window.open(url, '_blank');
            } else {
                alert('The URL is invalid: ' + url);
            }
        });
    });

    function isValidUrl(url) {
        try {
            new URL(url);
            return true;
        } catch (e) {
            return false;
        }
    }


    document.querySelectorAll('.lock-status-switch').forEach(function (switchElement) {
        switchElement.addEventListener('change', function () {
            const isChecked = switchElement.checked;
            const macAddress = switchElement.getAttribute('data-mac');
            const roomId = switchElement.getAttribute('data-room');
            const newCommand = isChecked ? 'lock' : 'unlock';

            const baseUrl = '<?php echo base_url(); ?>';
            fetch(`${baseUrl}/api/v1/smart-door/change-lock`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    mac_address: macAddress,
                    room_id: roomId,
                    command: newCommand
                })
            })
                .then(response => response.json())
                .then(data => {
                    console.log("🚀 ~ data:", data)
                    if (data.success) {
                        alert('Change status successfully');
                    } else {
                        alert('Change status failed');
                        switchElement.checked = !isChecked;
                    }
                })
                .catch(error => {
                    alert('Change status failed');
                    switchElement.checked = !isChecked;
                });
        });
    });

    document.querySelectorAll('.edit-device-button').forEach(function (button) {
        button.addEventListener('click', function () {
            // const macAddress = button.getAttribute('data-mac');
            const esp32Url = button.getAttribute('data-url');
            const floorplanId = button.getAttribute('data-floorplanid');

            // document.getElementById('mac_address').value = macAddress;
            document.getElementById('esp32_url').value = esp32Url;
            document.getElementById('floorplan_id').value = floorplanId;
            const editDeviceModal = new bootstrap.Modal(document.getElementById('editDeviceModal'));

            editDeviceModal.show();

        });

    });

    document.getElementById('saveDeviceButton').addEventListener('click', function () {
        // const macAddress = document.getElementById('mac_address').value;
        const saveButton = this;
        const originalText = saveButton.textContent;

        // Show loading state
        saveButton.disabled = true;
        saveButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';

        const esp32Url = document.getElementById('esp32_url').value;
        const floorplanId = document.getElementById('floorplan_id').value;

        const baseUrl = '<?php echo base_url(); ?>';
        fetch(`${baseUrl}/api/v1/smart-door/register-device`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                // mac_address: macAddress,
                esp32_url: esp32Url,
                floorplan_id: floorplanId
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Update successfully !!')
                    location.reload();
                } else {
                    alert('Update failed !!')
                }
            })
            .catch(error => {
                alert('An error occurred !!');
            })
            .finally(() => {
                saveButton.disabled = false;
                saveButton.textContent = originalText;
            });
    });
</script>