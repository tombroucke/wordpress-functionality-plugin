<?php

namespace FunctionalityPlugin;

use FunctionalityPlugin\Concerns\HasHooks;

class Admin
{
    use HasHooks;

    public function runHooks()
    {
        $this->addAction('admin_footer', 'repeaterBranchInstructions');
    }

    public function repeaterBranchInstructions()
    {
        $currentScreen = get_current_screen();

        if (! $currentScreen || $currentScreen->id !== 'toplevel_page_functionality-plugin-settings') {
            return;
        }

        ?>
        <script>
        (function () {
            function updateBranchInstructions(repeater) {
                repeater.querySelectorAll('.acf-row:not(.acf-clone)').forEach(function (row, index) {
                    row.querySelectorAll('.acf-label p.description').forEach(function (el) {
                        if (!el.dataset.originalInstruction) {
                            el.dataset.originalInstruction = el.textContent;
                        }
                        el.textContent = el.dataset.originalInstruction.replace(/branch="(\d+)"/, 'branch="' + index + '"');
                    });
                });
            }

            document.querySelectorAll('.acf-field-repeater').forEach(updateBranchInstructions);

            if (typeof acf !== 'undefined') {
                acf.addAction('append', function (el) {
                    var domEl = el instanceof jQuery ? el[0] : el;
                    var repeater = domEl.closest('.acf-field-repeater');
                    if (repeater) {
                        updateBranchInstructions(repeater);
                    }
                });

                acf.addAction('remove', function (el) {
                    var domEl = el instanceof jQuery ? el[0] : el;
                    var repeater = domEl.closest('.acf-field-repeater');
                    if (repeater) {
                        updateBranchInstructions(repeater);
                    }
                });

                acf.addAction('sortstop', function (el) {
                    var domEl = el instanceof jQuery ? el[0] : el;
                    var repeater = domEl.closest('.acf-field-repeater');
                    if (repeater) {
                        updateBranchInstructions(repeater);
                    }
                });
            }
        })();
        </script>
        <?php
    }
}
