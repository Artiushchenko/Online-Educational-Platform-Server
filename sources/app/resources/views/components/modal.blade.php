<div id="deleteModal" class="modal" style="display: none;">
    <div class="modal-content">
        <h2 id="modalTitle">Are you sure you want to delete this item?</h2>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="item_id" id="item_id">
            <button type="submit">Yes</button>
            <button type="button" class="remove-button" onclick="closeModal()">Cancel</button>
        </form>
    </div>
</div>

<script>
    function openModal(itemId, actionUrl, itemType) {
        document.getElementById('deleteModal').style.display = 'flex';
        document.getElementById('item_id').value = itemId;
        document.getElementById('deleteForm').action = actionUrl;

        let title = '';

        switch(itemType) {
            case 'user':
                title = 'Are you sure you want to delete this user?';
                break;
            case 'course':
                title = 'Are you sure you want to delete this course?';
                break;
            case 'lecture':
                title = 'Are you sure you want to delete this lecture?';
                break;
            case 'category':
                title = 'Are you sure you want to delete this category?';
                break;
            default:
                title = 'Are you sure you want to delete this item?';
        }
        document.getElementById('modalTitle').innerText = title;
    }

    function closeModal() {
        document.getElementById('deleteModal').style.display = 'none';
    }

</script>

<style>
    .modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 9999;
        width: 100%;
        height: 100%;
    }

    .modal-content {
        display: flex;
        flex-direction: column;
        gap: 10px;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
    }

    .modal-content h2 {
        font-size: 16px;
    }

    .modal-content #deleteForm {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    .remove-button {
        background-color: #FF0000;
    }

    .remove-button:hover {
        background-color: #8B0000;
    }
</style>
