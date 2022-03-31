<?php
session_start();

if (!(isset($_SESSION['logged']) && isset($_SESSION['isAdmin']))) {
    // IF USERS IS NOT LOGGED IN OR
    // IS LOGGED IN AND IS NOT ADMIN,
    // EXIT
    echo "<script>window.location = '" . str_replace("\n", "", $baseURL) . "'</script>";
    exit();
}

$title = "Προσθήκη Κανόνα";
$stylesheets =
    '<link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/add_form.css">
    ';
include '../header.php';
?>

<body>
    <?php include '../components/navbar.php'; ?>
    <div class="page-content">
        <div class="form-wrapper">
            <div class="form-container">
                <form>
                    <div class="form-section">
                        <label for="rule-name">Όνομα Κανόνα</label>
                        <input type="text" name="rule-name" id="rule-name">
                    </div>
                    <!-- DROPDOWN TO SELECT CORRESPONDING CATEGORY -->
                    <div class="form-section">
                        <label for="rule-category">Κατηγορία Κανόνα</label>
                        <select name="rule-category" id="rule-category">
                            <option value="" selected disabled>Επιλέξτε Κατηγορία</option>
                        </select>
                    </div>
                    <!-- DYNAMIC SECTIONS THAT HAVE A TEXT SECTION EXPLAINING THE RULE AND AN EXAMPLE SECTION 
                FOR POTENTIAL EXAMPLES -->
                    <div class="form-section rule-form-section" id="form-section-1">
                        <div class="sectionHeader">
                            <h3>Τμήμα Κανόνα</h3>
                        </div>
                        <label for="rule-section-1-text">Κείμενο Τμήματος</label>
                        <textarea name="rule-section-1-text" class="rule-section-text" key="1"></textarea>
                        <!-- <input type="text" name="rule-section-1-text" class="rule-section-text" key="1"> -->
                        <label for="rule-section-1-example">Παράδειγμα Τμήματος</label>
                        <!-- <input type="text" name="rule-section-1-example" class="rule-section-example" key="1"> -->
                        <textarea name="rule-section-1-example" class="rule-section-example" key="1"></textarea>
                    </div>
                    <div class="form-buttons">
                        <a class="button" href="#" onclick="addSectionInput()">Προσθήκη Τμήματος</a>
                        <a class="button green" href="#" onclick="submitForm()">Ολοκλήρωση</a>
                    </div>
                </form>
            </div>
            <div class="format-helper">
                <table>
                    <tr>
                        <td>!!κείμενο/!! <i class="fi fi-rr-arrow-right"></i></td>
                        <td class="special-text-1">κείμενο</td>
                    </tr>
                    <tr>
                        <td>**κείμενο/** <i class="fi fi-rr-arrow-right"></i></td>
                        <td class="special-text-2">κείμενο</td>
                    </tr>
                    <tr>
                        <td>$κείμενο/$ <i class="fi fi-rr-arrow-right"></i></td>
                        <td class="special-text-3">κείμενο</td>
                    </tr>
                    <tr>
                        <td>#κείμενο/# <i class="fi fi-rr-arrow-right"></i></td>
                        <td class="special-text-4">κείμενο</td>
                    </tr>
                    <tr>
                        <td>%κείμενο/% <i class="fi fi-rr-arrow-right"></i></td>
                        <td class="special-text-5">κείμενο</td>
                    </tr>
                    <tr>
                        <td>^κείμενο/^ <i class="fi fi-rr-arrow-right"></i></td>
                        <td class="special-text-6">κείμενο</td>
                    </tr>
                    <tr>
                        <td>&κείμενο/& <i class="fi fi-rr-arrow-right"></i></td>
                        <td class="special-text-7">κείμενο</td>
                    </tr>
                    <tr>
                        <td>@κείμενο/@ <i class="fi fi-rr-arrow-right"></i></td>
                        <td class="special-text-8">κείμενο</td>
                    </tr>
                    <tr>
                        <td>?κείμενο/? <i class="fi fi-rr-arrow-right"></i></td>
                        <td class="special-text-9">κείμενο</td>
                    </tr>
                    <tr>
                        <td>[κείμενο/] <i class="fi fi-rr-arrow-right"></i></td>
                        <td class="special-text-10 test">κείμενο</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script src="<?php echo $baseURL ?>/js/textFormat.js"></script>
    <script>
        let form = document.querySelector("form");
        let formButtons = document.querySelector(".form-buttons");
        let selectCategory = document.querySelector("#rule-category");
        // let submitFormBtn = document.querySelector(".form-buttons").lastElementChild;

        function addSectionInput() {
            let formSectionCount = document.querySelectorAll(".rule-form-section").length;

            let formSection = document.createElement("div");
            formSection.classList.add("rule-form-section");
            formSection.setAttribute("id", `form-section-${formSectionCount + 1}`);

            let sectionHeader = document.createElement("div");
            sectionHeader.classList.add("section-header");
            let header = document.createElement("h3");
            header.innerText = "Τμήμα Κανόνα";

            let delBtn = document.createElement("a");
            delBtn.classList.add("button", "red");
            delBtn.innerText = "Διαγραφή";
            delBtn.addEventListener("click", () => {
                deleteFormSection(formSectionCount + 1);
            });

            sectionHeader.appendChild(header);
            sectionHeader.appendChild(delBtn);

            let inputElement1 = document.createElement("textarea");
            let labelElement1 = document.createElement("label");
            let inputElement2 = document.createElement("textarea");
            let labelElement2 = document.createElement("label");


            labelElement1.setAttribute("for", `rule-section-${formSectionCount + 1}-text`);
            labelElement1.innerText = "Κείμενο Τμήματος";
            inputElement1.setAttribute("name", `rule-section-${formSectionCount + 1}-text`);
            // inputElement1.setAttribute("type", "text");
            inputElement1.setAttribute("key", `${formSectionCount + 1}`);
            inputElement1.classList.add("rule-section-text");

            labelElement2.setAttribute("for", `rule-section-${formSectionCount + 1}-example`);
            labelElement2.innerText = "Παράδειγμα Τμήματος";
            inputElement2.setAttribute("name", `rule-section-${formSectionCount + 1}-example`);
            // inputElement2.setAttribute("type", "text");
            inputElement2.setAttribute("key", `${formSectionCount + 1}`);
            inputElement2.classList.add("rule-section-example");

            formSection.appendChild(sectionHeader);
            formSection.appendChild(labelElement1);
            formSection.appendChild(inputElement1);
            formSection.appendChild(labelElement2);
            formSection.appendChild(inputElement2);

            formButtons.remove();

            form.appendChild(formSection);
            form.appendChild(formButtons);
        }

        function deleteFormSection(idToDelete) {
            let elementToDelete = document.querySelector(`#form-section-${idToDelete}`);
            elementToDelete.remove();
        }

        function submitForm() {
            const ruleName = document.querySelector("#rule-name").value;
            const ruleCategory = selectCategory.value;
            const ruleSections = document.querySelectorAll(".rule-form-section");

            const ruleSectionText = [];
            const ruleSectionExample = [];

            const searchParams = new URLSearchParams();

            searchParams.append("submit", "submit");

            let textStr = "";
            for (const rule of ruleSections) {
                const text = rule.querySelector(".rule-section-text");
                const example = rule.querySelector(".rule-section-example");
                textStr += '<div class="rule"><div class="rule-section">';
                if (text) {
                    ruleSectionText.push(filterText(text.value));
                    textStr += `<p class="rule-text">${filterText(text.value)}</p>`;
                }
                if (example && example.value != "") {
                    ruleSectionExample.push(filterText(example.value));
                    textStr += `<div class="rule-example"><p class="rule-example-header">Παράδειγμα</p><p class="example">${filterText(example.value)}</p></div>`;
                }
                textStr += '</div></div>';
            }

            searchParams.append("rule-name", ruleName);
            searchParams.append("rule-category", ruleCategory);
            searchParams.append("rule-text", textStr);

            fetch(`/${baseURL}/includes/newRuleHandler.php`, {
                    method: "POST",
                    body: searchParams,
                }).then(function(response) {
                    return response.text();
                })
                .then(function(text) {
                    let error = text.split("=")[1];
                    switch (error) {
                        case "none":
                            window.location = `/${baseURL}/routes/admin_panel.php`;
                            break;
                        case "userDoesNotExist":
                            window.alert("Δεν υπάρχει χρήστης με αυτό το όνομα / email.");
                            break;
                        case "wrongPassword":
                            window.alert("Ο κωδικός που δώσατε είναι λάθος!");
                            break;
                        default:
                            break;
                    }
                })
                .catch(function(error) {
                    console.log(error);
                });
        }

        fetch(`/${baseURL}/includes/fetchCategoriesOptions.php`).then((res) => {
            return res.text();
        }).then((text) => {
            selectCategory.innerHTML += text;
            // console.log(text);
        }).catch((error) => {
            console.error(`${error}`);
        });
    </script>
    <?php include '../components/footer.php'; ?>