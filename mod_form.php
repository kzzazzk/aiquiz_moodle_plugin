<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * The main mod_aiquiz configuration form.
 *
 * @package     mod_aiquiz
 * @copyright   2024 Zakaria Lasry z.lsahraoui@alumnos.upm.es
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/quiz/mod_form.php');
require_once($CFG->dirroot.'/mod/quiz/mod_form.php');


/**
 * Module instance settings form.
 *
 * @package     mod_aiquiz
 * @copyright   2024 Zakaria Lasry z.lsahraoui@alumnos.upm.es
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class mod_aiquiz_mod_form extends mod_quiz_mod_form {
    /**
     * Defines forms elements
     */
    public function definition() {
        $mform = $this->_form;

        // Add assignment submission.
        $mform->addElement('header', 'assignmenttiming', get_string('assignmenttiming', 'aiquiz'));

        // Open and close dates for assignments.
        $mform->addElement('date_time_selector', 'assignmentopen', get_string('assignmentopen', 'aiquiz'),
            self::$datefieldoptions);
        $mform->addHelpButton('assignmentopen', 'assignmentopenclose', 'aiquiz');

        $mform->addElement('date_time_selector', 'assignmentclose', get_string('assignmentclose', 'aiquiz'),
            self::$datefieldoptions);

        parent::definition();

    }
    /**
     * Defines form behaviour after being defined
     */
    public function definition_after_data() {
        parent::definition_after_data();
        $mform = $this->_form;

        $general = $mform->getElement('general');
        $name = $mform->getElement('name');
        $introeditor = $mform->getElement('introeditor');

        $mform->removeElement('general');
        $mform->removeElement('name');
        $mform->removeElement('introeditor');

        $mform->insertElementBefore($general, 'assignmenttiming');
        $mform->insertElementBefore($name, 'assignmenttiming');
        $mform->insertElementBefore($introeditor, 'assignmenttiming');

        $mform->getElement('timing')->setValue('Quiz Timing');
    }

}