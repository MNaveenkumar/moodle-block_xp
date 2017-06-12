<?php
// This file is part of Moodle - http://moodle.org/
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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Log controller.
 *
 * @package    block_xp
 * @copyright  2017 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_xp\local\controller;
defined('MOODLE_INTERNAL') || die();

use moodle_exception;

/**
 * Log controller class.
 *
 * @package    block_xp
 * @copyright  2017 Frédéric Massart - FMCorz.net
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class log_controller extends page_controller {

    protected $routename = 'log';

    /** @var int The current group ID. */
    protected $groupid;

    protected function post_login() {
        parent::post_login();
        $this->groupid = groups_get_course_group($this->manager->get_course(), true);
    }

    protected function get_table() {
        $courseid = $this->manager->get_courseid();
        $table = new \block_xp\output\log_table('block_xp_log', $courseid, $this->groupid);
        $table->define_baseurl($this->pageurl);
        return $table;
    }

    protected function get_page_html_head_title() {
        return get_string('courselog', 'block_xp');
    }

    protected function get_page_heading() {
        return get_string('courselog', 'block_xp');
    }

    protected function page_content() {
        groups_print_course_menu($this->manager->get_course(), $this->pageurl);
        echo $this->get_table()->out(50, true);
    }

}
