/** @param {string} listSelector */
export function setupCheckBoxes(listSelector = "") {
    if (listSelector.length > 0) {
        const selectionList = document.querySelectorAll(`${listSelector} > [data-username] input`);

        // toggle elements recpient list
        for (const selection of selectionList) {
            selection.addEventListener("change", () => {
                const targetId = selection.closest('[data-username]')?.dataset?.userid
                const targetName = selection.closest('[data-username]')?.dataset?.username
                const recipients = document.querySelectorAll(`${"#recipient-list"} > [data-username]`);
                let hasElement = false;
                for (const element of recipients) {
                    if (element.dataset.userid == targetId) {
                        element.remove();
                        hasElement = true;
                    }
                }
                if (hasElement === false) {
                    if (targetId && targetName) createRecipient(targetId, targetName)
                }
            });
        }
    }
}

/** @param {string} id, @param {string} listid */
export function getSelectedBox(id = "", listid = "recipient-list") {
    if (id.toString().length > 0) {
        const searchedNode = document.querySelector(`#${listid} > [data-userid="${id.toString()}"]`);
        return searchedNode;
    }
    else {
        return null;
    }
}

/** @param {Event} event */
export function filterInput(event) {
    const input = event.target.value;
    /** @type Nodelist<HTMLDivElement> */
    const selectionList = event.target.closest(".total-overview-container").querySelectorAll('[data-username]');
    for (const selection of selectionList) {
        // console.log(selection.dataset.username)
        if (selection.dataset.username.toLowerCase().includes(input.toLowerCase())) {
            selection.classList.remove("d-none");
        }
        else { selection.classList.add("d-none"); }
    }
}

export function selectedRecipient(params, inputSelector) {
    createRecipient(params.item.id, params.item.value)
}

/** Add
 * @param {string} id
 * @param {string} name */
export function createRecipient(id, name) {
    if (getSelectedBox(id)) { }
    else {
        let temp = document.getElementsByTagName("template")[0];
        let clon = temp.content.cloneNode(true)?.querySelector('button');
        clon.dataset.username = name;
        clon.dataset.userid = id;
        clon.querySelector("input").setAttribute("value", id);
        clon.querySelector("input").setAttribute("id", name + "-" + id);
        clon.querySelector("input").setAttribute("checked", true);
        clon.querySelector("label").innerText = name;
        clon.querySelector("label").setAttribute("for", name + "-" + id);
        clon.addEventListener("click", (event) => removeRecipient(event));
        document.querySelector("#recipient-list").appendChild(clon);
        setCheckbox(true, ".total-overview", id)
        setCheckbox(true, ".latest-overview", id)
    }
}

/** @param {Event} event */
export function removeRecipient(event) {
    event.preventDefault();
    /** @type HTMLDivElement */
    event.currentTarget.remove();
    setCheckbox(false, ".total-overview", event.currentTarget.dataset.userid)
    setCheckbox(false, ".latest-overview", event.currentTarget.dataset.userid)
}

/**  @param {boolean} value  @param {string} listSelector */
function setCheckbox(value, listSelector, targetId) {
    if (listSelector.length > 0) {
        const selectionList = document.querySelectorAll(`${listSelector} > [data-username] input`);

        for (const element of selectionList) {
            const boxId = element.closest('[data-username]')?.dataset?.userid
            if (boxId == targetId) {
                element.checked = value
            }
        }
    }
}