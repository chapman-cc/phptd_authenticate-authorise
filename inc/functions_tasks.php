<?php
//task functions

function getTasks($where = null)
{
    global $db;
    $query = "SELECT * FROM tasks ";
    $query .= "WHERE user_uid='" . cookie() . "'";
    if (!empty($where)) $query .= "AND $where";
    $query .= " ORDER BY id";

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $tasks = $statement->fetchAll();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return $tasks;
}
function getIncompleteTasks()
{
    return getTasks('status=0');
}
function getCompleteTasks()
{
    return getTasks('status=1');
}
function getTask($task_id)
{
    global $db;

    try {
        $uid = cookie();
        $statement = $db->prepare("SELECT id, task, status FROM tasks WHERE id=:id AND user_uid='$uid'");
        $statement->bindParam('id', $task_id);
        $statement->execute();
        $task = $statement->fetch();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return $task;
}
function createTask($data)
{
    global $db;
    try {
        $statement = $db->prepare('INSERT INTO tasks (task, status, user_uid) VALUES (:task, :status, :user_uid)');
        $statement->bindParam('task', $data['task']);
        $statement->bindParam('status', $data['status']);
        $statement->bindParam('user_uid', $data['user_uid']);
        $statement->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return getTask($db->lastInsertId());
}
function updateTask($data)
{
    global $db;

    try {
        getTask($data['task_id']);
        $uid = cookie();
        $statement = $db->prepare("UPDATE tasks SET task=:task, status=:status WHERE id=:id AND user_uid='$uid'");
        $statement->bindParam('task', $data['task']);
        $statement->bindParam('status', $data['status']);
        $statement->bindParam('id', $data['task_id']);
        $statement->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return getTask($data['task_id']);
}
function updateStatus($data)
{
    global $db;

    try {
        getTask($data['task_id']);
        $uid = cookie();
        $statement = $db->prepare("UPDATE tasks SET status=:status WHERE id=:id AND user_uid='$uid'");
        $statement->bindParam('status', $data['status']);
        $statement->bindParam('id', $data['task_id']);
        $statement->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return getTask($data['task_id']);
}
function deleteTask($task_id)
{
    global $db;

    try {
        getTask($task_id);
        $uid = cookie();
        $statement = $db->prepare("DELETE FROM tasks WHERE id=:id AND user_uid = '$uid'");
        $statement->bindParam('id', $task_id);
        $statement->execute();
    } catch (Exception $e) {
        echo "Error!: " . $e->getMessage() . "<br />";
        return false;
    }
    return true;
}
