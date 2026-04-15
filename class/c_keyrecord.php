<?php

class Keyrecord
{
	protected ?int   $id;
	protected string $sleutel;
	protected string $waarde;

	private PDO $connection;

	// -------------------------------------------------------------------
	// Constructor: alleen dependency injection, geen logica
	// -------------------------------------------------------------------
	public function __construct(PDO $connection)
	{
		$this->connection = $connection;
		$this->id         = null;
		$this->sleutel    = '';
		$this->waarde     = '';
	}

	// -------------------------------------------------------------------
	// Static factory methods (vervangt constructor-overloading hack)
	// -------------------------------------------------------------------

	/**
	 * Maak een Keyrecord op basis van een DB-rij.
	 */
	public static function fromRow(PDO $connection, array $row): self
	{
		$obj          = new self($connection);
		$obj->id      = (int) $row['id'];
		$obj->sleutel = $row['sleutel'];   // decoderen bij output, niet hier
		$obj->waarde  = $row['waarde'];
		return $obj;
	}

	/**
	 * Haal een Keyrecord op uit de DB via de sleutel.
	 * Geeft null terug als niet gevonden.
	 */
	public static function fromSleutel(PDO $connection, string $sleutel): ?self
	{
		try {
			$sql  = "SELECT id, sleutel, waarde FROM keytabel WHERE sleutel = :sleutel";
			$stmt = $connection->prepare($sql);
			$stmt->bindValue(':sleutel', $sleutel, PDO::PARAM_STR);
			$stmt->execute();
			$row  = $stmt->fetch(PDO::FETCH_ASSOC);

			if (!$row) {
				// Sleutel niet gevonden: geef leeg object terug met de sleutel alvast ingevuld
				$obj          = new self($connection);
				$obj->sleutel = $sleutel;
				return $obj;
			}

			return self::fromRow($connection, $row);

		} catch (PDOException $e) {
			error_log('Keyrecord::fromSleutel mislukt: ' . $e->getMessage());
			return null;
		}
	}

	// -------------------------------------------------------------------
	// Expliciete getters (in plaats van magische __get)
	// -------------------------------------------------------------------

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getSleutel(): string
	{
		return htmlspecialchars($this->sleutel, ENT_QUOTES, 'UTF-8'); // decoderen bij output
	}

	public function getWaarde(): string
	{
		return $this->waarde;
	}

	// -------------------------------------------------------------------
	// Expliciete setters
	// -------------------------------------------------------------------

	public function setSleutel(string $sleutel): void
	{
		$this->sleutel = $sleutel;
	}

	public function setWaarde(string $waarde): void
	{
		$this->waarde = $waarde;
	}

	// -------------------------------------------------------------------
	// DB-operaties
	// -------------------------------------------------------------------

	/**
	 * Nieuw record opslaan. Vult $this->id na insert.
	 */
	public function saveToDB(): bool
	{
		try {
			$sql = "INSERT INTO keytabel (sleutel, waarde)
					VALUES (:sleutel, :waarde)";

			$stmt = $this->connection->prepare($sql);
			$stmt->bindValue(':sleutel', $this->sleutel, PDO::PARAM_STR);
			$stmt->bindValue(':waarde',  $this->waarde,  PDO::PARAM_STR);
			$stmt->execute();

			$this->id = (int) $this->connection->lastInsertId();
			return true;

		} catch (PDOException $e) {
			error_log('Keyrecord::saveToDB mislukt: ' . $e->getMessage());
			return false;
		}
	}

	/**
	 * Bestaand record bijwerken.
	 */
	public function updateToDB(): bool
	{
		if ($this->id === null) {
			error_log('Keyrecord::updateToDB: geen id, gebruik saveToDB()');
			return false;
		}

		try {
			$sql = "UPDATE keytabel
					SET sleutel = :sleutel,
						waarde  = :waarde
					WHERE id    = :id";

			$stmt = $this->connection->prepare($sql);
			$stmt->bindValue(':id',      $this->id,      PDO::PARAM_INT);
			$stmt->bindValue(':sleutel', $this->sleutel, PDO::PARAM_STR);
			$stmt->bindValue(':waarde',  $this->waarde,  PDO::PARAM_STR);
			$stmt->execute();
			return true;

		} catch (PDOException $e) {
			error_log('Keyrecord::updateToDB mislukt: ' . $e->getMessage());
			return false;
		}
	}

	// -------------------------------------------------------------------
	// Hulpmethoden
	// -------------------------------------------------------------------

	public function isNew(): bool
	{
		return $this->id === null;
	}

	public function __toString(): string
	{
		return '$id      : ' . ($this->id ?? 'null')  . '<br>' .
			   '$sleutel : ' . $this->getSleutel()    . '<br>' .
			   '$waarde  : ' . $this->getWaarde()     . '<br>';
	}
}