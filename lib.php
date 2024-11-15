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
 * Library of interface functions and constants.
 *
 * @package     mod_aiquiz
 * @copyright   2024 Zakaria Lasry z.lsahraoui@alumnos.upm.es
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Return if the plugin supports $feature.
 *
 * @param string $feature Constant representing the feature.
 * @return true | null True if the feature is supported, null otherwise.
 */
require_once($CFG->dirroot . '/mod/quiz/lib.php');

function aiquiz_supports($feature) {
    switch ($feature) {
        case FEATURE_PLAGIARISM:
            return true;
        case FEATURE_MOD_PURPOSE:
            return MOD_PURPOSE_ASSESSMENT;
        case FEATURE_GRADE_HAS_GRADE:
            return FEATURE_GRADE_HAS_GRADE;
    }
}
/**
 * Saves a new instance of the mod_aiquiz into the database.
 *
 * Given an object containing all the necessary data, (defined by the form
 * in mod_form.php) this function will create a new instance and return the id
 * number of the instance.
 *
 * @param object $moduleinstance An object from the form.
 * @param mod_aiquiz_mod_form $mform The form.
 * @return int The id of the newly inserted record.
 */
function aiquiz_add_instance($moduleinstance, $mform) {
    global $DB, $CFG;

    // Create a new quiz object and set its properties.
    $quiz = new stdClass();
    $quiz->course = $moduleinstance->course;
    $quiz->name = $moduleinstance->name;
    $quiz->intro = $moduleinstance->intro;
    $quiz->introformat = $moduleinstance->introformat;
    $quiz->timeopen = $moduleinstance->timeopen;
    $quiz->timeclose = $moduleinstance->timeclose;
    $quiz->preferredbehaviour = $moduleinstance->preferredbehaviour;
    $quiz->attempts = $moduleinstance->attempts;
    $quiz->quizpassword = $moduleinstance->quizpassword;
    $quiz->timemodified = time();
    $quiz->grade = $moduleinstance->grade;
    $quiz->questions = $moduleinstance->questions;
    $quiz->module = $DB->get_field('modules', 'id', array('name' => 'quiz'), MUST_EXIST);

    // Update the course module ID in the quiz object.
    $quiz->coursemodule = add_course_module($quiz);

    // Insert the quiz into the database using quiz_add_instance.
    $quiz_id = quiz_add_instance($quiz);

    // Update the instance field of the course module now that we have the quiz ID.
    $DB->set_field('course_modules', 'instance', $quiz_id, array('id' =>  $quiz->coursemodule));

    // Now you can use the quiz ID in your custom table.
    $moduleinstance->timecreated = time();
    $moduleinstance->assignment_id = 1; // Replace with actual assignment ID logic.
    $moduleinstance->quiz_id = $quiz_id;

    // Insert the record into the custom table.
    $id = $DB->insert_record('aiquiz', $moduleinstance);

    // Create questions and add them to the quiz.
    foreach ($moduleinstance->questions as $questiontext) {
        global $DB;

        $question = new stdClass();
        $question->category = 1;
        $question->parent = 1;
        $question->name = 'Sample Question';
        $question->questiontext = $questiontext;
        $question->questiontextformat = FORMAT_HTML;
        $question->generalfeedback = '';
        $question->generalfeedbackformat = FORMAT_HTML;
        $question->defaultmark = 1.0;
        $question->penalty = 0.1;
        $question->qtype = 'multichoice';
        $question->length = 1;
        $question->stamp = make_unique_id_code();
        $question->version = make_unique_id_code();
        $question->hidden = 0;
        $question->timecreated = time();
        $question->timemodified = time();
        $question->createdby = 2; // Admin ID or the ID of the user creating the question
        $question->modifiedby = 2; // Admin ID or the ID of the user modifying the question

        // Insert the question into the database.
        $question->id = $DB->insert_record('question', $question);
        quiz_add_quiz_question($question->id, $quiz, 1, 1.0);
    }

    return $id;
}




/**
 * Updates an instance of the mod_aiquiz in the database.
 *
 * Given an object containing all the necessary data (defined in mod_form.php),
 * this function will update an existing instance with new data.
 *
 * @param object $moduleinstance An object from the form in mod_form.php.
 * @param mod_aiquiz_mod_form $mform The form.
 * @return bool True if successful, false otherwise.
 */
function aiquiz_update_instance($moduleinstance, $mform = null) {
    global $DB;

    $moduleinstance->timemodified = time();
    $moduleinstance->id = $moduleinstance->instance;

    return $DB->update_record('aiquiz', $moduleinstance);
}

/**
 * Removes an instance of the mod_aiquiz from the database.
 *
 * @param int $id Id of the module instance.
 * @return bool True if successful, false on failure.
 */
function aiquiz_delete_instance($id) {
    global $DB;

    $exists = $DB->get_record('aiquiz', ['id' => $id]);
    if (!$exists) {
        return false;
    }

    $DB->delete_records('aiquiz', ['id' => $id]);

    return true;
}
