document.addEventListener('DOMContentLoaded', function () {
    let tags = document.querySelectorAll('[data-component="tag"]')
    tags.forEach(/** @param {HTMLElement} tag */tag => {
        setIconVisibility(tag);
        tag.addEventListener("click", (event) => {
            let input = tag.querySelector("input");

            toggleChildren(tag);
        })
    });
});

/** @param {HTMLElement} node */
function setIconVisibility(node) {
    /** @type HTMLDivElement */
    let icon = node.querySelector('[data-element="icon"]');

    /// Hide icon if no children
    let sibling = node.nextElementSibling

    icon.style.visibility = checkHasChildren(node, node) ? "visible" : "hidden";
}

/**
 * @param {Element} tag
 * @param {Element} firstParent ultimate parent element */
function checkHasChildren(tag, firstParent) {
    /** * @type {Element}*/
    let sibling = tag.nextElementSibling;
    if (sibling) {
        if (sibling?.getAttribute("data-used") === "true") {

            /** @type string */
            let parentPath = firstParent.dataset.path;
            if (sibling?.dataset?.path?.startsWith(parentPath + "/") ?? false) {
                return true;
            }
            else {
                return false;
            }
        } else {
            return checkHasChildren(sibling, firstParent)
        }
    }
}

/** @param {HTMLElement} node */
function findParentPath(node) {
    let tags = document.querySelectorAll('[data-component="tag"]');
    let currentNode = node;
    let path = [currentNode.dataset.id];
    while (currentNode.dataset.parentid != null) {
        let startid = currentNode.dataset.id;
        tags.forEach(/** @param {HTMLElement} parenttag  */parenttag => {
            if (parenttag.dataset.id == currentNode.dataset.parentid) {
                currentNode = parenttag;
                path.unshift(currentNode.dataset.id);
            }
        });
        if (currentNode.dataset.id == startid) break;
    }
    return path;
}

/** @param {HTMLElement} node */
function toggleChildren(node) {
    let childtags = document.querySelectorAll('[data-component="tag"][data-parentid="' + node.dataset.id + '"]');
    let icon = node.querySelector('[data-element="icon"]');
    if (node.dataset.open == "false") {
        icon.classList.remove("fa-chevron-down");
        icon.classList.add("fa-chevron-right");
        node.dataset.open = "true";
    }
    else {
        icon.classList.remove("fa-chevron-right");
        icon.classList.add("fa-chevron-down");
        node.dataset.open = "false";
    }

    childtags.forEach(/** @param {HTMLElement} child  */child => {
        if (node.dataset.open == "false") {
            child.style.display = "block";
            child.dataset.open = "false";
        } else {
            child.style.display = "none";
            child.dataset.open = "true";
        }
    });
}