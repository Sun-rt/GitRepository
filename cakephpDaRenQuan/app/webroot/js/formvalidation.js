/**
 * @author zhaohui
 */

function validate_required(field) {
    with (field) {
        if (value == null || value == "") {
            return false
        } else {
            return true
        }
    }
}