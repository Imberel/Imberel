<?php

namespace Imberel\Imberel\Core\Session;

/**
 *  Class
 *
 * @author Binkap S <real.desert.tiger@gmail.com>
 */
class FilesSystemSession
{
    public function storage(): bool;

    public function write(string $id, object|array|null $data = null): bool;

    public function read(string $id): object|bool;

    public function destroy(string $id): bool;

    public function gc(int $max): bool;

    public function set(string $userid, int $remember): bool;

    public function get(): string;

    public function guest(string $id): bool;

    public function updateId(string $id, string $userid): bool;

    public function updateData(string $id, object|array $data): bool;

    public function updateRemember(string $id, int $remember): bool;

    public function insertSess(string $id): bool;

    public function updateSess(string $id): bool;
}