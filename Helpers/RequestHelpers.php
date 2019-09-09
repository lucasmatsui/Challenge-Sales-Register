<?php
namespace Helpers;

class RequestHelpers {

    public function verifyRequestWasPost() {
		if ($_SERVER["REQUEST_METHOD"] === "POST") return true;
		return false;
	}

	public function redirectToPage() {
		?>
			<script type="text/javascript">
				window.location.replace("<?php echo BASE_URL; ?>");
			</script>
		<?php
	}

}