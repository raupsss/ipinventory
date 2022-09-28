1:
SELECT a.nim,nama_lengkap,b.nilai_mutu
FROM mahasiswa AS a
JOIN nilai AS b
ON a.nim=b.nim
WHERE nilai_mutu='a'