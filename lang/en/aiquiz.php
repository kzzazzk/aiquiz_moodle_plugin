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
 * Plugin strings are defined here.
 *
 * @package     mod_aiquiz
 * @category    string
 * @copyright   2024 Zakaria Lasry z.lsahraoui@alumnos.upm.es
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'AI Quiz';
$string['modulename'] = 'AI Quiz';
$string['modulenameplural'] = 'AI Quizzes';
$string['yourcontext'] = 'Context of knowledge needed for the test';
$string['modulename_help'] = 'The AI Quiz plugin enables teachers to create personalized quizzes with AI-generated questions based on student-uploaded content. It includes all standard quiz features plus:

* A long-text input for specifying required knowledge
* Custom dates for practice submission and quiz opening
* File upload option for students before practice submission deadline
* AI-generated quizzes based on uploaded content
* AI-generated feedback on quiz performance

Quizzes may be used

* As personalized course exams
* As practice tests tailored to student submissions
* To provide immediate and specific feedback on performance
* For customized self-assessment';
$string['aiquizname'] = 'Name';
$string['quiztiming'] = 'Quiz Timing';
$string['introduction'] = 'Introduction';
$string['assignmenttiming'] = 'Assignment Submission Timing';
$string['assignmentopen'] = 'Open assignment submissions';
$string['assignmentclose'] = 'Close assignment submissions';
$string['quizopen'] = 'Open the quiz';
$string['quizclose'] = 'Close the quiz';
$string['timelimit'] = 'Time limit';
$string['overduehandling'] = 'When time expires';
$string['graceperiod'] = 'Submission grace period';
$string['expectedknowledge'] = 'Expected knowledge for the accomplishment of the assignment';
$string['quizopenclose_help'] = 'Students can only start their attempt(s) after the open time and they must complete their attempts before the close time.';
$string['assignmentopenclose_help'] = 'Students can only start submiting their assignments after the open time and they must have submitted their attempts before the close time.';
$string['overduehandlingautosubmit'] = 'Open attempts are submitted automatically';
$string['overduehandlinggraceperiod'] = 'There is a grace period when open attempts can be submitted, but no more questions answered';
$string['overduehandlingautoabandon'] = 'Attempts must be submitted before time expires, or they are not counted';
$string['grade'] = 'Grade';
$string['attemptlast'] = 'Last attempt';
$string['attemptfirst'] = 'First attempt';
$string['gradeaverage'] = 'Average grade';
$string['gradehighest'] = 'Highest grade';
$string['attemptsallowed'] = 'Attempts allowed';
$string['grademethod'] = 'Grading method';
$string['layout'] = 'Layout';
$string['newpage'] = 'New page';
$string['repaginatenow'] = 'Repaginate now';
$string['navmethod'] = 'Navigation method';

