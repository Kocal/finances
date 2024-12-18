import { Controller } from "@hotwired/stimulus";

/**
 * @property {HTMLInputElement} inputFileTarget
 * @property {HTMLButtonElement} buttonImportTarget
 */
export default class extends Controller {
	static targets = ["inputFile", "buttonImport"];

	connect() {
		this.buttonImportTarget.addEventListener(
			"click",
			this.onImportClick.bind(this),
		);
		this.inputFileTarget.addEventListener(
			"change",
			this.onFileChange.bind(this),
		);
	}

	disconnect() {
		this.buttonImportTarget.removeEventListener(
			"click",
			this.onImportClick.bind(this),
		);
		this.inputFileTarget.removeEventListener(
			"change",
			this.onFileChange.bind(this),
		);
	}

	onImportClick() {
		this.inputFileTarget.click();
	}

	onFileChange() {
		console.log(this.element);
		this.element.submit();
	}
}
